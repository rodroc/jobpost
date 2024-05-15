"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
var _Workzag_data;
Object.defineProperty(exports, "__esModule", { value: true });
const axios_1 = __importDefault(require("axios"));
class Workzag {
    constructor() {
        _Workzag_data.set(this, ``);
    }
    async getData() {
        let request = axios_1.default.create({
            responseType: 'text',
            responseEncoding: 'utf8'
        });
        this.data = await request.get(this.url);
        console.log({ data: this.data });
    }
    parse() {
    }
}
_Workzag_data = new WeakMap();
Workzag.url = 'https://mrge-group-gmbh.jobs.personio.de/xml';
exports.default = Workzag;
