"use strict";
var __classPrivateFieldGet = (this && this.__classPrivateFieldGet) || function (receiver, state, kind, f) {
    if (kind === "a" && !f) throw new TypeError("Private accessor was defined without a getter");
    if (typeof state === "function" ? receiver !== state || !f : !state.has(receiver)) throw new TypeError("Cannot read private member from an object whose class did not declare it");
    return kind === "m" ? f : kind === "a" ? f.call(receiver) : f ? f.value : state.get(receiver);
};
var __classPrivateFieldSet = (this && this.__classPrivateFieldSet) || function (receiver, state, value, kind, f) {
    if (kind === "m") throw new TypeError("Private method is not writable");
    if (kind === "a" && !f) throw new TypeError("Private accessor was defined without a setter");
    if (typeof state === "function" ? receiver !== state || !f : !state.has(receiver)) throw new TypeError("Cannot write private member to an object whose class did not declare it");
    return (kind === "a" ? f.call(receiver, value) : f ? f.value = value : state.set(receiver, value)), value;
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
var _Workzag_url, _Workzag_data;
Object.defineProperty(exports, "__esModule", { value: true });
const axios_1 = __importDefault(require("axios"));
const xml2js_1 = __importDefault(require("xml2js"));
class Workzag {
    constructor() {
        _Workzag_url.set(this, 'https://mrge-group-gmbh.jobs.personio.de/xml');
        this.rootText = 'workzag-jobs';
        _Workzag_data.set(this, ``);
    }
    async getData() {
        try {
            const request = axios_1.default.create({
                responseType: 'text',
                responseEncoding: 'utf8'
            });
            __classPrivateFieldSet(this, _Workzag_data, (await request.get(__classPrivateFieldGet(this, _Workzag_url, "f"))).data, "f");
        }
        catch (e) {
            throw e;
        }
    }
    async parse() {
        try {
            return xml2js_1.default.parseStringPromise(__classPrivateFieldGet(this, _Workzag_data, "f"), { trim: true });
        }
        catch (e) {
            console.error({ e });
            throw new Error(`Can't parse data.`);
        }
    }
    async getGenericList() {
        try {
            const data = await this.getData();
            const xmlData = await this.parse();
            const jobs = [];
            for (const item of Object.entries(xmlData['workzag-jobs'])) {
                const details = item[1];
                const jobDescriptions = details[0].jobDescriptions[0]['jobDescription'][0].value;
                let job = {
                    id: parseInt(details[0].id[0]),
                    title: details[0].name[0],
                    emptype: details[0].employmentType[0],
                    description: jobDescriptions[0],
                    link: __classPrivateFieldGet(this, _Workzag_url, "f"),
                    created_at: details[0].createdAt[0]
                };
                jobs.push(job);
            }
            return jobs;
        }
        catch (error) {
            throw error;
        }
    }
}
_Workzag_url = new WeakMap(), _Workzag_data = new WeakMap();
exports.default = Workzag;
