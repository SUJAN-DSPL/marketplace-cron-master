import { cn } from "@/lib/utils";
import { Button } from "./ui/button";
import DashboardIcon from "@mui/icons-material/Dashboard";
import CalendarMonthIcon from "@mui/icons-material/CalendarMonth";
import { Link } from "@inertiajs/react";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "./ui/accordion";
import TerminalIcon from '@mui/icons-material/Terminal';

interface SideNavigationBarProps extends React.HTMLAttributes<HTMLDivElement> {}

export function SideNavigationBar({ className }: SideNavigationBarProps) {
    return (
        <div className={cn("pb-12 top-0", className)}>
            <div className="space-y-4 py-4">
                <div className="px-3 py-1">
                    <h2 className="mb-2 px-4 text-2xl font-semibold tracking-tight">
                        <span className="text-primary">Cron</span>{" "}
                        <span>Master</span>
                    </h2>
                    <div className=" mt-5">
                        <Accordion type="single" collapsible className="w-full flex gap-2 flex-col">
                            <Link href={route("dashboard")}>
                                <Button
                                    variant={
                                        route().current("dashboard")
                                            ? "secondary"
                                            : "ghost"
                                    }
                                    className="w-full justify-start"
                                >
                                    <DashboardIcon className="mr-3" />
                                    Dashboard
                                </Button>
                            </Link>

                            <AccordionItem
                                value="item-1"
                                className="w-full p-0 border-none"
                            >
                                <AccordionTrigger className="w-full">
                                    <Button
                                        variant={
                                            route().current("schedulers*")
                                                ? "secondary"
                                                : "ghost"
                                        }
                                        className="w-full justify-start"
                                    >
                                        <CalendarMonthIcon className="mr-3" />
                                        Scheduler
                                        {/* <ChevronDown className="h-4 w-4 shrink-0 transition-transform duration-200" /> */}
                                    </Button>
                                </AccordionTrigger>
                                
                                <AccordionContent className="flex flex-col gap-1 border rounded-md p-1 mt-1">
                                    <Link href={route("schedulers.index")}>
                                        <Button
                                            variant={
                                                route().current(
                                                    "schedulers.index"
                                                )
                                                    ? "secondary"
                                                    : "ghost"
                                            }
                                            className="w-full justify-start"
                                        >
                                            All Schedulers
                                        </Button>
                                    </Link>

                                    <Link href={route("schedulers.create")}>
                                        <Button
                                            variant={
                                                route().current(
                                                    "schedulers.create"
                                                )
                                                    ? "secondary"
                                                    : "ghost"
                                            }
                                            className="w-full justify-start"
                                        >
                                            Create Scheduler
                                        </Button>
                                    </Link>
                                </AccordionContent>
                            </AccordionItem>

                            <Link href={route("cron-logs.index")}>
                                <Button
                                    variant={
                                        route().current("cron-logs.index")
                                            ? "secondary"
                                            : "ghost"
                                    }
                                    className="w-full justify-start"
                                >
                                    <TerminalIcon className="mr-3" />
                                    Logs
                                </Button>
                            </Link>
                        </Accordion>
                    </div>
                </div>
            </div>
        </div>
    );
}
