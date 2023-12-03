export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};

export type SchedulerFromInputsType = {
    name: string;
    description: string;
    is_active: boolean;
    cron_job_class: string;
    frequencies: Array<{
        frequency_id: number;
        frequency_params: Array<number> | [];
    }>;
    timezone: string;
    notifiable_emails: Array<string>;
    notify_on_slack: boolean;
};

export type SchedulerReturnType = {
    uuid: string
    name: string;
    description: string;
    is_active: boolean;
    cron_job_class: string;
    frequencies: Array<{
        id: number;
        label: string;
        method: string;
        params_details: Array<{ name: string; description: string }>;
        pivot: {
            scheduler_id: string;
            frequency_id: number;
            frequency_params: Array<number> | [];
        };
    }>;
    timezone: string;
    notifiable_emails: Array<string>;
    notify_on_slack: boolean;
};
