import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { PageProps, SchedulerReturnType } from "@/types";
import { UseQueryResult, useQuery } from "@tanstack/react-query";
import axios from "axios";
import { Badge } from "@/Components/ui/badge";

const Index = ({ auth }: PageProps) => {
    const schedulers = useQuery({
        queryKey: ["all-schedulers"],
        queryFn: async () => (await axios.get(route("all-schedulers"))).data,
    }) as UseQueryResult<Array<SchedulerReturnType>>;

    return (
        <AuthenticatedLayout user={auth.user} header={<p>Scheduler Logs</p>}>
            <div className="w-full">
                <div
                    className="coding inverse-toggle px-5 shadow-lg text-gray-100 text-sm font-mono subpixel-antialiased 
                        bg-gray-800  pb-6 pt-4 rounded-lg leading-normal overflow-hidden h-[75vh]"
                >
                    <div className="top mb-2 flex">
                        <div className="h-3 w-3 bg-red-500 rounded-full"></div>
                        <div className="ml-2 h-3 w-3 bg-orange-300 rounded-full"></div>
                        <div className="ml-2 h-3 w-3 bg-green-500 rounded-full"></div>
                    </div>

                    <div className="mt-4 flex">
                        <span className="text-green-400">
                            finances cron job:~$
                        </span>
                        <p className="flex-1 typing items-center pl-2 ">
                            Started At: 46
                            <span className="ml-2">
                                <Badge
                                    variant="default"
                                    className="bg-gray-400"
                                >
                                    Draft
                                </Badge>
                            </span>
                            <span className="ml-2">
                                <Badge variant="default" className="">
                                    Running
                                </Badge>
                            </span>
                            <span className="ml-2">
                                <Badge
                                    variant="default"
                                    className="bg-green-400"
                                >
                                    Completed
                                </Badge>
                            </span>
                            Completed At : 43.8 seconds
                            <br />
                            <div className=" w-full p-3 border border-red-400 mt-5 rounded-lg text-red-400">
                                class not found
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Index;
