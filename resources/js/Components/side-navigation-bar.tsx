import { cn } from "@/lib/utils";
import { Button } from "./ui/button";
import DashboardIcon from '@mui/icons-material/Dashboard';
import CalendarMonthIcon from '@mui/icons-material/CalendarMonth';
import { Link } from "@inertiajs/react";

interface SideNavigationBarProps extends React.HTMLAttributes<HTMLDivElement> {}

export function SideNavigationBar({ className }: SideNavigationBarProps) {
    return (
        <div className={cn("pb-12 fixed", className)}>
            <div className="space-y-4 py-4">
                <div className="px-3 py-1">
                    <h2 className="mb-2 px-4 text-2xl font-semibold tracking-tight">
                        <span className="text-primary">Cron</span>{" "}
                        <span>Master</span>
                    </h2>
                    <div className="space-y-1 mt-5">
                        <Link href={route("dashboard")}>
                            <Button
                                variant={route().current('dashboard')?"secondary":"ghost"}
                                className="w-full justify-start"
                            >
                                <DashboardIcon className="mr-3" />
                                Dashboard
                            </Button>
                        </Link>

                        <Link href={route("schedulers.create")}>
                            <Button
                                variant={route().current('schedulers*')?"secondary":"ghost"}
                                className="w-full justify-start"
                            >
                                <CalendarMonthIcon  className="mr-3" />
                                Scheduler
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
