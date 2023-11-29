import { cn } from "@/lib/utils";
import { Button } from "./ui/button";
import { LuLayoutDashboard } from "react-icons/lu";
import { GrSchedule } from "react-icons/gr";
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
                                <LuLayoutDashboard size={17} className="mr-2" />
                                Dashboard
                            </Button>
                        </Link>

                        <Link href={route("schedulers.create")}>
                            <Button
                                variant={route().current('schedulers*')?"secondary":"ghost"}
                                className="w-full justify-start"
                            >
                                <GrSchedule size={17} className="mr-2" />
                                Scheduler
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
