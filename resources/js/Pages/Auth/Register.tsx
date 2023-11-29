import { useEffect, FormEventHandler } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";
import { Label } from "@/Components/ui/label";
import { Input } from "@/Components/ui/input";
import Error from "@/Components/ui/error";
import SubmitButton from "@/Components/ui/submit_button";

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    useEffect(() => {
        return () => {
            reset("password", "password_confirmation");
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("register"));
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <div className="flex flex-col space-y-2 text-center">
                <h1 className="text-2xl font-semibold tracking-tight">
                    Register Your account
                </h1>
                <p className="text-sm text-muted-foreground">
                    Register your account to access the dashboard
                </p>
            </div>

            <form onSubmit={submit}>
                <div className="grid w-full items-center gap-3">
                    <div className="flex flex-col space-y-1.5">
                        <Label htmlFor="name">Name</Label>
                        <Input
                            disabled={processing}
                            id="name"
                            placeholder="Enter your first name"
                            onChange={(e) => setData("name", e.target.value)}
                        />
                        <Error position="right" message={errors.name} />
                    </div>

                    <div className="flex flex-col space-y-1.5">
                        <Label htmlFor="email">Email</Label>
                        <Input
                            disabled={processing}
                            id="email"
                            placeholder="Enter your email"
                            onChange={(e) => setData("email", e.target.value)}
                        />
                        <Error position="right" message={errors.email} />
                    </div>

                    <div className="flex flex-col space-y-1.5">
                        <Label htmlFor="password">Password</Label>
                        <Input
                            disabled={processing}
                            type="password"
                            id="password"
                            placeholder="Enter your password"
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                        />
                        <Error position="right" message={errors.password} />
                    </div>

                    <div className="flex flex-col space-y-1.5">
                        <Label htmlFor="confirm_password">
                            Confirm Password
                        </Label>
                        <Input
                            disabled={processing}
                            type="password"
                            id="confirm_password"
                            placeholder="Confirm your password"
                            onChange={(e) =>
                                setData("password_confirmation", e.target.value)
                            }
                        />
                        <Error
                            position="right"
                            message={errors.password_confirmation}
                        />
                    </div>

                    <SubmitButton
                        isLoading={processing}
                        className="w-full relative"
                    >
                        Sign Up
                    </SubmitButton>
                </div>
            </form>

            <p className="px-8 text-center text-sm text-muted-foreground">
               Already have an account? {" "}
                <Link
                    href="/login"
                    className="underline underline-offset-4 hover:text-primary"
                >
                    Log In
                </Link>
            </p>
        </GuestLayout>
    );
}
