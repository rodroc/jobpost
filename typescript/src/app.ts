import express,{Request,Response} from 'express'
import http from 'http'
import cors from 'cors'
// import { Server,Socket } from 'socket.io'

import {IGenericJobs,IGenericJob} from './integration/Generic'
import {IWorkzagJob,IWorkzagJobs} from './integration/Workzag'
import Workzag from './integration/Workzag'

const app = express()
app.use(express.urlencoded({extended:true}))
app.use(cors())
const server = http.createServer(app)
// const io:Server = new Server(server)

const cache:IGenericJobs=[] // similar concept to using Redis
// const sockets:Array<Socket>=[]

app.get('/workzagjobs',async (req:Request,res:Response)=>{
    const integration = new Workzag()
    const jobs:IGenericJobs = await integration.getGenericList()
    res.status(200).json(jobs)
})

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

server.listen(8089, () => {
    console.log('listening on *:8089');
});
