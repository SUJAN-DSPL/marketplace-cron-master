import { useEffect, FormEventHandler } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import { Head, useForm } from "@inertiajs/react";
import SubmitButton from "@/Components/ui/submit_button";
import Error from "@/Components/ui/error";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";

export default function ResetPassword({
    token,
    email,
}: {
    token: string;
    email: string;
}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        token: token,
        email: email,
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

        post(route("password.store"));
    };

    return (
        <GuestLayout>
            <Head title="Reset Password" />

            <div className="flex flex-col space-y-2 text-center">
                <h1 className="text-2xl font-semibold tracking-tight">
                    Reset Your Password
                </h1>
                <p className="text-sm text-muted-foreground">
                   Enter a strong Password
                </p>
            </div>

            <form onSubmit={submit}>
                <div>
                    <Label htmlFor="email">Email</Label>

                    <Input
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        disabled={true}
                        onChange={(e) => setData("email", e.target.value)}
                    />

                    <Error message={errors.email} position={"right"} className="mt-2" />
                </div>

                <div className="mt-4">
                    <Label htmlFor="password">Password</Label>

                    <Input
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        disabled={processing}
                        onChange={(e) => setData("password", e.target.value)}
                    />

                    <Error message={errors.password} position={"right"}  className="mt-2" />
                </div>

                <div className="mt-4">
                    <Label htmlFor="email">Confirm Password</Label>

                    <Input
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        disabled={processing}
                        onChange={(e) =>
                            setData("password_confirmation", e.target.value)
                        }
                    />

                    <Error
                        message={errors.password_confirmation} position={"right"} 
                        className="mt-2"
                    />
                </div>

                <div className="flex items-center justify-end mt-4">
                    <SubmitButton
                        className="ms-4"
                        disabled={processing}
                        isLoading={processing}
                    >
                        Reset Password
                    </SubmitButton>
                </div>
            </form>
        </GuestLayout>
    );
}
