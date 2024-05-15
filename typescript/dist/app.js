"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const http_1 = __importDefault(require("http"));
const cors_1 = __importDefault(require("cors"));
const Workzag_1 = __importDefault(require("./integration/Workzag"));
const app = (0, express_1.default)();
app.use(express_1.default.urlencoded({ extended: true }));
app.use((0, cors_1.default)());
const server = http_1.default.createServer(app);
// const io:Server = new Server(server)
const cache = []; // similar concept to using Redis
// const sockets:Array<Socket>=[]
app.get('/workzagjobs', async (req, res) => {
    const integration = new Workzag_1.default();
    const jobs = await integration.getGenericList();
    res.status(200).json(jobs);
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
server.listen(8089, () => {
    console.log('listening on *:8089');
});
