"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const http_1 = __importDefault(require("http"));
const cors_1 = __importDefault(require("cors"));
// import { Server,Socket } from 'socket.io'
const DbTask_1 = __importDefault(require("./DbTask"));
const Workzag_1 = __importDefault(require("./integration/Workzag"));
const dbTask = new DbTask_1.default();
const app = (0, express_1.default)();
app.use(express_1.default.urlencoded({ extended: true }));
app.use((0, cors_1.default)());
const server = http_1.default.createServer(app);
// const io:Server = new Server(server)
const cache = [];
// const sockets:Array<Socket>=[]
app.get('/workzagjobs', async (req, res) => {
    const integration = new Workzag_1.default();
    const jobs = await integration.getGenericList();
    res.status(200).json(jobs);
    /*
    try{
        const data:any = await integration.getData()
        const xmlData:any = await integration.parse()
        const jobs:IGenericJobs=[]
        for(const item of Object.entries(xmlData['workzag-jobs'])){
            // console.log('item',item[1])
            const details:any = item[1]
            // console.log(details[0],details[0].name[0])
            let job:IGenericJob = {
                title:details[0].name[0],
                description:'',
                link:''}
            jobs.push(job)
        }
        // console.log({jobs})
        res.status(200).json(jobs)
    }catch(error){throw error}*/
});
/*
io.on('connection', (socket) => {
    console.log(`User connected with id: ${socket.id}`);
    sockets.push(socket)
    socket.emit(`jobs.demo`,cache)
    socket.on('disconnect', () => {
        console.log(`User id: ${socket.id} disconnected.`);
    });
})
*/
server.listen(3000, () => {
    console.log('listening on *:3000');
});
