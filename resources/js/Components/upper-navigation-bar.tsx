"use client"

import { Link } from "@inertiajs/react";
import { Avatar, AvatarFallback, AvatarImage } from "./ui/avatar";
import { Button, buttonVariants } from "./ui/button";
import {
     DropdownMenu,
     DropdownMenuContent,
     DropdownMenuItem,
     DropdownMenuTrigger
} from "./ui/dropdown-menu";


import { FC } from 'react'
import React from "react";
import ThemeToggler from "./ui/theme-toggler";



interface UpperNavigationBarProps {
}


const UpperNavigationBar: FC<UpperNavigationBarProps> = () => {
    return (
        <header className='supports-backdrop-blur:bg-background/60 sticky top-0 z-40 w-full 
        border-b bg-background/95 backdrop-blur md:px-5'>
            <div className=" flex h-14 items-center justify-end selection">
                <div className="text-xl md:text-2xl font-semibold">
                   
                </div>
                <div className="flex items-center justify-between space-x-2 md:justify-end">  
                    <ThemeToggler />
                    <ProfileDropDown />
                </div>
                
            </div>
        </header>
    )
}

export default UpperNavigationBar



const ProfileDropDown = React.forwardRef<
    HTMLDivElement,
    React.HTMLAttributes<HTMLDivElement>
>(({ className, title, children, ...props }, ref) => {
    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button variant="outline" size="icon">
                    <Avatar>
                        <AvatarImage src="https://github.com/shadcn.png" />
                        <AvatarFallback>CN</AvatarFallback>
                    </Avatar>
                </Button>
            </DropdownMenuTrigger>

            <DropdownMenuContent align="end" className="p-1 border rounded-md mt-2 cursor-pointer w-28">
                <DropdownMenuItem className="relative flex select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 cursor-pointer">
                    <Link href={route("profile.edit")}>Profile</Link>
                </DropdownMenuItem>
                <DropdownMenuItem 
                    className="relative flex select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 cursor-pointer">
                    <Link href={route('logout')} method="post">Logout</Link>
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    )
})

ProfileDropDown.displayName = "ProfileDropDown"