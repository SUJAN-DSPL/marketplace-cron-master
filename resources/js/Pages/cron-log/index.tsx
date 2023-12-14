import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { CronLogType, PageProps } from "@/types";
import { UseQueryResult, useQuery } from "@tanstack/react-query";
import axios from "axios";
import { Badge } from "@/Components/ui/badge";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/Components/ui/accordion";

const Index = ({ auth }: PageProps) => {
    const cronLogs = useQuery({
        queryKey: ["cron-logs"],
        queryFn: async () => (await axios.get(route("cron-logs.logs"))).data,
        refetchInterval: 5000,
    }) as UseQueryResult<Array<CronLogType>>;

    return (
        <AuthenticatedLayout user={auth.user} header={<p>Scheduler Logs</p>}>
            <div className="w-full">
                <div
                    className="coding inverse-toggle px-5 shadow-lg text-gray-100 text-sm font-mono subpixel-antialiased 
                         bg-gray-800  pb-6 pt-4 rounded-lg leading-normal overflow-hidden h-[75vh] overflow-y-auto custom-scrollbar relative"
                >
                    <div className="top mb-2 flex py-5">
                        <div className="h-3 w-3 bg-red-500 rounded-full"></div>
                        <div className="ml-2 h-3 w-3 bg-orange-300 rounded-full"></div>
                        <div className="ml-2 h-3 w-3 bg-green-500 rounded-full"></div>
                    </div>

                    {cronLogs.data &&
                        cronLogs.data.map((log, index) => (
                            <div className="mt-4 flex" key={index}>
                                <span className="text-green-400">
                                    {log.scheduler.name}:~$
                                </span>
                                <div className="flex-1 typing items-center pl-2 ">
                                    <div className="flex items-center gap-2">
                                        <span className="ml-2">
                                            Status:{" "}
                                            <Badge
                                                variant="default"
                                                status={log.status.label}
                                            >
                                                {log.status.label}
                                            </Badge>
                                        </span>
                                        <span>
                                            <span className="underline">
                                                Started At
                                            </span>
                                            :{" "}
                                            <small className=" text-muted-foreground">
                                                {" "}
                                                {log.started_at}
                                            </small>
                                        </span>
                                        {log.ended_at && (
                                            <span>
                                                {" "}
                                                <span className=" underline">
                                                    Stopped At
                                                </span>{" "}
                                                :{" "}
                                                <small className=" text-muted-foreground">
                                                    {" "}
                                                    {log.ended_at}
                                                </small>
                                            </span>
                                        )}
                                    </div>

                                    {log.exception && (
                                        <div className=" w-full p-3 border border-red-400 border-dotted mt-5 rounded-lg text-red-400">
                                            <Accordion
                                                type="single"
                                                collapsible
                                            >
                                                <AccordionItem
                                                    value="item-1"
                                                    className="p-0 border-none"
                                                >
                                                    <AccordionTrigger>
                                                        {log.exception.message}
                                                    </AccordionTrigger>
                                                    <AccordionContent className="mt-5">
                                                        {log.exception.trace}
                                                    </AccordionContent>
                                                </AccordionItem>
                                            </Accordion>
                                        </div>
                                    )}
                                </div>
                            </div>
                        ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Index;
