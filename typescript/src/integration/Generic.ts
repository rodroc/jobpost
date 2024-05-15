export interface IGenericJob{
    id:number,
    title:string,
    emptype:string,
    description:string,
    link:string,
    created_at:string
}
export interface IGenericJobs extends Array<IGenericJob>{}


