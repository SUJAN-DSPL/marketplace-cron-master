import ThemeToggler from "@/Components/ui/theme-toggler";
import { PropsWithChildren } from "react";

export default function Guest({ children }: PropsWithChildren) {
    return (
        <main>
            <div className=" fixed top-5 right-5 z-50">
                <ThemeToggler />
            </div>

            <div className="container relative hidden h-[100vh] flex-col items-center justify-center md:grid lg:max-w-none lg:grid-cols-2 lg:px-0">
                <div className="relative hidden h-full flex-col text-white  lg:flex">
                    <img
                        src="/images/side-image.png"
                        alt="image"
                        className="h-[100vh]"
                    />
                </div>

                <div className="lg:p-8">
                    <div className="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                        {children}
                    </div>
                </div>
            </div>
        </main>
    );
}
