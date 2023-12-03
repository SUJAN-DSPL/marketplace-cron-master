import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { PageProps, SchedulerReturnType } from "@/types";
import { UseQueryResult, useQuery } from "@tanstack/react-query";
import axios from "axios";

const Index = ({ auth }: PageProps) => {
    const schedulers = useQuery({
        queryKey: ["all-schedulers"],
        queryFn: async () => (await axios.get(route("all-schedulers"))).data,
    }) as UseQueryResult<Array<SchedulerReturnType>>;

    console.log(schedulers.data);

    return (
        <AuthenticatedLayout user={auth.user} header={<p>Schedulers</p>}>
            <div className="border rounded-md p-3">
                <Table>
                    <TableCaption>A list of your recent invoices.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            {/* <TableHead className="w-[100px]">Id</TableHead> */}
                            <TableHead className="w-[100px]"> Name</TableHead>
                            <TableHead>Timezone</TableHead>
                            <TableHead className="">Frequency</TableHead>
                            <TableHead className="">Job</TableHead>
                            <TableHead className="text-right">
                                Is Active
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        {schedulers.data &&
                            schedulers.data.map((scheduler, index) => (
                                <TableRow key={index}>
                                    {/* <TableCell className="font-medium">
                                        {scheduler.uuid}
                                    </TableCell> */}
                                    <TableCell>{scheduler.name}</TableCell>
                                    <TableCell>{scheduler.timezone}</TableCell>
                                    <TableCell className="">
                                        {scheduler.frequencies[0].label}
                                    </TableCell>
                                    <TableCell className="">
                                        {scheduler.cron_job_class}
                                    </TableCell>
                                    <TableCell className="text-right">
                                        {scheduler.is_active ? "true" : "false"}
                                    </TableCell>
                                </TableRow>
                            ))}
                    </TableBody>

                    {/* <TableFooter>
                        <TableRow>
                            <TableCell colSpan={3}>Total</TableCell>
                            <TableCell className="text-right">
                                $2,500.00
                            </TableCell>
                        </TableRow>
                    </TableFooter> */}
                </Table>
            </div>
        </AuthenticatedLayout>
    );
};

export default Index;
