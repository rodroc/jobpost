
import axios from 'axios'
import xml2js from 'xml2js'

import {IGenericJobs,IGenericJob} from './Generic'

export interface IWorkzagJob{
    id:number,
    subcompany:string,
    office:string,
    department:string,
    recruitingCategory:string,
    name:string,
    jobDescriptions:Array<string>,
    employmentType:string,
    seniority:string,
    schedule:string,
    yearsOfExperience:string,
    keywords:string,
    occupation:string,
    occupationCategory:string,
    createdAt:string
}
export interface IWorkzagJobs extends Array<IWorkzagJob>{}

export default class Workzag{

	#url = 'https://mrge-group-gmbh.jobs.personio.de/xml'
	public readonly rootText:string ='workzag-jobs'
	#data:string = ``

	constructor(){}

	async getData(){
		try{
			const request = axios.create({
				responseType: 'text',
				responseEncoding: 'utf8'
			})
			this.#data = (await request.get(this.#url)).data
		}catch(e){throw e}
	}

	async parse(){
		try{
			return xml2js.parseStringPromise(this.#data,{trim: true})
		}catch(e){
			console.error({e})
			throw new Error(`Can't parse data.`)
		}
	}

	async getGenericList(){
		try{
	        const data:any = await this.getData()
	        const xmlData:any = await this.parse()
	        const jobs:IGenericJobs=[]
	        for(const item of Object.entries(xmlData['workzag-jobs'])){
	            const details:any = item[1]
	            const jobDescriptions = details[0].jobDescriptions[0]['jobDescription'][0].value
	            let job:IGenericJob = { 
	            	id:parseInt(details[0].id[0]),
	                title:details[0].name[0],
	                emptype: details[0].employmentType[0],
	                description: jobDescriptions[0],
	                link:this.#url,
	                created_at:details[0].createdAt[0]
	            }
	            jobs.push(job)
	        }
	    	return jobs
	    }catch(error){throw error}
	}
	
}

