import { useState, PropsWithChildren, ReactNode } from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import { Link } from "@inertiajs/react";
import { User } from "@/types";
import { SideNavigationBar } from "@/Components/side-navigation-bar";
import UpperNavigationBar from "@/Components/upper-navigation-bar";

export default function Authenticated({
    user,
    header,
    children,
}: PropsWithChildren<{ user: User; header?: ReactNode }>) {
    return (
        <div className="min-h-screen bg-background">
            <div className="grid lg:grid-cols-5">
                <div className="relative">
                    <SideNavigationBar className=" w-full"/>
                </div>

                <div className="col-span-3 lg:col-span-4 lg:border-l min-h-screen">
                    <UpperNavigationBar />

                    <main className="flex-1 space-y-4 p-8 pt-4">
                        {header && (
                            <div className="flex items-center justify-between space-y-2">
                                <h2 className="text-2xl font-bold tracking-tight text-muted-foreground">
                                    {header}
                                </h2>
                            </div>
                        )}
                        {children}
                    </main>
                </div>
            </div>
        </div>
    );
}
