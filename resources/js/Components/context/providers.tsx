"use client";

import { QueryClient, QueryClientProvider } from "@tanstack/react-query";

import { ReactQueryDevtools } from "@tanstack/react-query-devtools";
import { ThemeProvider } from "./theme-provider";
import { TooltipProvider } from "@radix-ui/react-tooltip";
import { Toaster } from "../ui/toaster";

interface Props {
    children: React.ReactNode;
}

const queryClient = new QueryClient();

export default function Provider({ children }: Props) {
    return (
        <QueryClientProvider client={queryClient}>
            <TooltipProvider>
                <ThemeProvider
                    defaultTheme="system"
                    storageKey="vite-ui-theme"
                >
                     <Toaster />
                    {children}
                </ThemeProvider>
            </TooltipProvider>
            <ReactQueryDevtools initialIsOpen={true} />
        </QueryClientProvider>
    );
}
