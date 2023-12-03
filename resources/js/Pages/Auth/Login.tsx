import { useEffect, FormEventHandler } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { cn } from "@/lib/utils";
import { Button } from "@/Components/ui/button";
import { Label } from "@/Components/ui/label";
import { Input } from "@/Components/ui/input";
import SubmitButton from "@/Components/ui/submit_button";
import Error from "@/Components/ui/error";
import { Checkbox } from "@/Components/ui/checkbox";
import GoogleIcon from "@mui/icons-material/Google";
export default function Login({
    status,
    canResetPassword,
}: {
    status?: string;
    canResetPassword: boolean;
}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset("password");
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("login"));
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            {status && (
                <div className="mb-4 font-medium text-sm text-green-600">
                    {status}
                </div>
            )}

            <div className="flex flex-col space-y-2 text-center">
                <h1 className="text-2xl font-semibold tracking-tight">
                    Login Your account
                </h1>
                <p className="text-sm text-muted-foreground">
                    Enter your credentials to access the dashboard
                </p>
            </div>

            <div className={cn("grid gap-6", "")}>
                <form onSubmit={submit}>
                    <div className="grid w-full items-center gap-3">
                        <div className="flex flex-col space-y-1.5">
                            <Label htmlFor="email">Email</Label>
                            <Input
                                id="email"
                                placeholder="Enter your email"
                                disabled={processing}
                                onChange={(e) =>
                                    setData("email", e.target.value)
                                }
                            />
                            <Error message={errors.email} position={"right"} />
                        </div>

                        <div className="flex flex-col space-y-1.5">
                            <Label htmlFor="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                placeholder="Enter your password"
                                disabled={processing}
                                onChange={(e) =>
                                    setData("password", e.target.value)
                                }
                            />
                            <Error
                                message={errors.password}
                                position={"right"}
                            />
                        </div>

                        <div className="block">
                            <label className="flex items-center">
                                <Checkbox
                                    name="remember"
                                    checked={data.remember}
                                    disabled={processing}
                                    onCheckedChange={(e: any) =>
                                        setData("remember", !data.remember)
                                    }
                                />
                                <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    Remember me
                                </span>
                            </label>
                        </div>

                        <div className="flex items-center justify-between mt-4">
                            {canResetPassword && (
                                <Link
                                    href={route("password.request")}
                                    className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                >
                                    Forgot your password?
                                </Link>
                            )}

                            <SubmitButton isLoading={processing}>
                                Sign Up
                            </SubmitButton>
                        </div>
                    </div>
                </form>

                <div className="relative">
                    <div className="absolute inset-0 flex items-center">
                        <span className="w-full border-t" />
                    </div>
                    
                    <div className="relative flex justify-center text-xs uppercase">
                        <span className="bg-background px-2 text-muted-foreground">
                            Or continue with
                        </span>
                    </div>
                </div>
                
                <Button
                    variant="outline"
                    className=" hover:text-muted-foreground"
                    type="button"
                    disabled={false}
                >
                    <GoogleIcon className="mr-2" /> Google
                </Button>
            </div>

            <p className="px-8 text-center text-sm text-muted-foreground">
                Don't have account?{" "}
                <Link
                    href="/register"
                    className="underline underline-offset-4 hover:text-primary"
                >
                    Sign Up
                </Link>
            </p>
        </GuestLayout>
    );
}
