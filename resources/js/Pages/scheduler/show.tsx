import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {
    PageProps,
    SchedulerFromInputsType,
    SchedulerReturnType,
} from "@/types";
import { Button } from "@/Components/ui/button";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import { Textarea } from "@/Components/ui/textarea";
import { useForm } from "@inertiajs/react";
import { useScheduler } from "@/Components/hooks/use-scheduler";
import { Checkbox } from "@/Components/ui/checkbox";
import SubmitButton from "@/Components/ui/submit_button";
import { FormEventHandler, useEffect } from "react";
import Error from "@/Components/ui/error";
import useToastMessage from "@/Components/hooks/use-toast-message";

const Show = ({
    auth,
    scheduler,
}: PageProps<{ scheduler: SchedulerReturnType }>) => {
    const { timezones, frequencies, cronJobs } = useScheduler();
    const [setToasterMessage] = useToastMessage();

    const {
        data,
        setData,
        post,
        processing,
        errors,
        reset,
        recentlySuccessful,
    } = useForm<SchedulerFromInputsType>({
        name: "",
        description: "",
        is_active: false,
        cron_job_class: "",
        frequencies: [{ frequency_id: 2, frequency_params: [] }],
        timezone: "Asia/Kolkata",
        notifiable_emails: [],
        notify_on_slack: false,
    });

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("schedulers.store"));
    };

    useEffect(() => {
        if (!recentlySuccessful) return;
        setToasterMessage({ success: "Scheduler has been saved successfully" });
        return () => {
            reset();
        };
    }, [recentlySuccessful]);

    return (
        <AuthenticatedLayout user={auth.user} header={<p>/Scheduler/Update</p>}>
            <Card>
                <CardHeader>
                    <CardTitle>Create Your Scheduler</CardTitle>
                    <CardDescription>
                        Create a new Scheduler for a particular Job
                    </CardDescription>
                </CardHeader>
                <form onSubmit={handleSubmit}>
                    <CardContent className="grid gap-6">
                        <div className="grid grid-cols-2 gap-4">
                            <div className="grid gap-2">
                                <Label htmlFor="name">Scheduler Name</Label>
                                <Input
                                    id="name"
                                    placeholder="Enter a unique Name Of the scheduler"
                                    onChange={(e) =>
                                        setData("name", e.target.value)
                                    }
                                />
                                <Error position="right" message={errors.name} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="cron_job_class">
                                    Select the Job
                                </Label>
                                <Select
                                    onValueChange={(value) =>
                                        setData(
                                            "cron_job_class",
                                            `App\\Jobs\\${value}`
                                        )
                                    }
                                >
                                    <SelectTrigger
                                        id="cron_job_class"
                                        className="line-clamp-1  truncate"
                                    >
                                        <SelectValue placeholder="Select level" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {cronJobs.data &&
                                            cronJobs.data.map(
                                                (cronjob, index) => (
                                                    <SelectItem
                                                        value={cronjob}
                                                        key={index}
                                                    >
                                                        {cronjob}
                                                    </SelectItem>
                                                )
                                            )}
                                    </SelectContent>
                                </Select>
                                <Error
                                    position="right"
                                    message={errors.cron_job_class}
                                />
                            </div>
                        </div>

                        <div className="grid gap-4">
                            <div className="grid gap-2">
                                <Label htmlFor="security-level">
                                    Select Time zone
                                </Label>

                                <Select
                                    defaultValue={data.timezone}
                                    onValueChange={(value) =>
                                        setData("timezone", value)
                                    }
                                >
                                    <SelectTrigger
                                        id="security-level"
                                        className="line-clamp-1 truncate"
                                    >
                                        <SelectValue placeholder="Select level" />
                                    </SelectTrigger>
                                    <SelectContent className="h-[30vh]">
                                        {timezones.data &&
                                            timezones.data.map(
                                                (timezone, index) => (
                                                    <SelectItem
                                                        key={index}
                                                        value={timezone}
                                                    >
                                                        {timezone}
                                                    </SelectItem>
                                                )
                                            )}
                                    </SelectContent>
                                </Select>
                                <Error
                                    position="right"
                                    message={errors.timezone}
                                />
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="frequencies">
                                Frequency (next run time: 2.10AM)
                            </Label>
                            <Select
                                defaultValue={`${data.frequencies?.[0].frequency_id}`}
                                onValueChange={(value) =>
                                    setData("frequencies", [
                                        {
                                            frequency_id: parseInt(value),
                                            frequency_params: [],
                                        },
                                    ])
                                }
                            >
                                <SelectTrigger
                                    id="frequencies"
                                    className="line-clamp-1  truncate"
                                >
                                    <SelectValue placeholder="Select the  frequency" />
                                </SelectTrigger>
                                <SelectContent className=" h-[30vh]">
                                    {frequencies.data &&
                                        frequencies.data.map(
                                            (frequency, index) => (
                                                <SelectItem
                                                    key={index}
                                                    value={`${frequency.id}`}
                                                >
                                                    {frequency.label}
                                                </SelectItem>
                                            )
                                        )}
                                </SelectContent>
                            </Select>
                            <Error
                                position="right"
                                message={errors.frequencies}
                            />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="notifiable_emails">
                                Notifiable Emails
                            </Label>
                            <Input
                                id="notifiable_emails"
                                placeholder="enter your all emails by , separator"
                                onChange={(e) =>
                                    setData(
                                        "notifiable_emails",
                                        e.target.value
                                            .split(",")
                                            .map((email) => email.trim())
                                    )
                                }
                            />
                            <Error
                                position="right"
                                message={errors.notifiable_emails}
                            />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="description">Description</Label>
                            <Textarea
                                id="description"
                                placeholder="Please include all information relevant to your issue."
                                onChange={(e) =>
                                    setData("description", e.target.value)
                                }
                            />
                            <Error
                                position="right"
                                message={errors.description}
                            />
                        </div>
                    </CardContent>

                    <CardFooter className="justify-between space-x-2">
                        <div className=" space-y-2">
                            <div className="block">
                                <label
                                    htmlFor="notify_on_slack"
                                    className="flex items-center"
                                >
                                    <Checkbox
                                        id="notify_on_slack"
                                        checked={data.notify_on_slack}
                                        disabled={processing}
                                        onCheckedChange={(e: any) =>
                                            setData(
                                                "notify_on_slack",
                                                !data.notify_on_slack
                                            )
                                        }
                                    />

                                    <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                        On Success Notify on Slack
                                    </span>
                                </label>
                            </div>

                            <div className="block">
                                <label
                                    htmlFor="is_active"
                                    className="flex items-center"
                                >
                                    <Checkbox
                                        id="is_active"
                                        checked={data.is_active}
                                        disabled={processing}
                                        onCheckedChange={(e: any) =>
                                            setData(
                                                "is_active",
                                                !data.is_active
                                            )
                                        }
                                    />
                                    <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                        Make it Active
                                    </span>
                                </label>
                            </div>
                        </div>

                        <SubmitButton isLoading={processing}>
                            Submit
                        </SubmitButton>
                    </CardFooter>
                </form>
            </Card>
        </AuthenticatedLayout>
    );
};

export default Show;
