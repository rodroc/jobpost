<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

// use Illuminate\Support\Facades\Route;
use App\Mail\JobPostMailer;
use Illuminate\Support\Facades\Mail;

use stdClass;

use App\Job;

class JobsController extends Controller
{
    private $externalLinks = [
        'http://host.docker.internal:8089/workzagjobs'
    ];

    private $empTypes = [
        'contract' => 'Contract',
        'temporary' => 'Temporary',
        'full-time' => 'Full-Time',
        'part-time' => 'Part-Time'
    ];

    public function combined(Request $request)
    {
        $combined = [];
        $jobs = Job::all();
        foreach ($jobs as $j) {
            $combined[] = [
                'id' => $j->id,
                'title' => $j->title,
                'description' => $j->description,
                'emptype' => $j->emptype,
                'link' => $j->link,
                'created_at' => (new \DateTime($j->created_at))->format('Y-m-d H:i:s')
            ];
        }
        // pull from remote source
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $this->externalLinks[0], [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => ['type' => 'base64']
        ]);
        $content = $response->getBody();
        $xJobs = json_decode($content);
        foreach ($xJobs as $row) {
            $combined[] = (array) $row;
        }
        return view('jobs.combined', ['jobs' => $combined]);
    }

    public function index(Request $request)
    {
        $jobs = Job::all();
        return view('jobs.index', ['jobs' => $jobs, 'empTypes' => $this->empTypes]);
    }

    public function create()
    {
        $job = new Job();
        return view('jobs.details', ['job' => $job, 'empTypes' => $this->empTypes]);
    }

    public function save(Request $request)
    {
        $j = new Job();
        $j->title = $request->title;
        $j->description = $request->description;
        $j->location = $request->location;
        $j->emptype = $request->emptype;
        $j->requirements = $request->requirements;
        $j->moderator_email = $request->moderator_email;
        $j->save();

        Mail::to('aromacor@gmail.com')->send(new JobPostMailer($j));

        // return back()->with('success', "Job Posted Successfully.");
        return redirect()->action('JobsController@index', [])->with('warning', "Job posted for review.");
    }

    public function update(Request $request)
    {
        $job = Job::whereId($request->id)->first();
        if ($request->has('title')) {
            $job->title = $request->title;
        }
        if ($request->has('description')) {
            $job->description = $request->description;
        }
        if ($request->has('emptype')) {
            $job->emptype = $request->emptype;
        }
        if ($request->has('moderator_email')) {
            $job->moderator_email = $request->moderator_email;
        }
        $job->active = in_array($request->active, ['on', '1', 1]) ? 1 : 0;
        $job->spam = in_array($request->spam, ['on', '1', 1]) ? 1 : 0;

        $job->save();

        return redirect()->action('JobsController@index', [])->with('info', "Job Updated Successfully.");
    }

    public function edit($id)
    {
        $job = Job::whereId($id)->first();
        return view('jobs.details', ['job' => $job, 'empTypes' => $this->empTypes]);
    }

    public function notspam($id)
    {
        $job = Job::whereId($id)->first();
        $job->active = 1;
        $job->spam = 0;
        $job->save();
        return redirect()->action('JobsController@index', [])->with('success', "Job published for hiring.");
    }

    public function spam($id)
    {
        $job = Job::whereId($id)->first();
        $job->active = 0;
        $job->spam = 1;
        $job->save();
        return redirect()->action('JobsController@index', [])->with('warning', "Job flagged as spam.");
    }
}
