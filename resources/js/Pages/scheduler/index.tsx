import { Label } from "@/Components/ui/label";
import { Switch } from "@/Components/ui/switch";
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
import RemoveRedEyeIcon from "@mui/icons-material/RemoveRedEye";
import { Link } from "@inertiajs/react";

const Index = ({ auth }: PageProps) => {
    const schedulers = useQuery({
        queryKey: ["all-schedulers"],
        queryFn: async () => (await axios.get(route("all-schedulers"))).data,
    }) as UseQueryResult<Array<SchedulerReturnType>>;

    return (
        <AuthenticatedLayout user={auth.user} header={<p>Schedulers</p>}>
            <div className="border rounded-md p-3">
                <Table>
                    <TableCaption>A list of your recent invoices.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead className="w-[100px]">Action</TableHead>
                            <TableHead className=""> Name</TableHead>
                            <TableHead className="">Timezone</TableHead>
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
                                    <TableCell className="font-medium  text-primary">
                                        <Link
                                            href={route(
                                                "schedulers.show",
                                                scheduler.uuid
                                            )}
                                        >
                                            <RemoveRedEyeIcon fontSize="small" />
                                        </Link>
                                    </TableCell>
                                    <TableCell>{scheduler.name}</TableCell>
                                    <TableCell>{scheduler.timezone}</TableCell>
                                    <TableCell className="">
                                        {scheduler.frequencies[0].label}
                                    </TableCell>
                                    <TableCell className="">
                                        {scheduler.cron_job_class}
                                    </TableCell>
                                    <TableCell className="text-right">
                                        <div className="flex items-center space-x-2 justify-end">
                                            <Switch
                                                id="airplane-mode"
                                                checked={scheduler.is_active}
                                            />
                                        </div>
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
