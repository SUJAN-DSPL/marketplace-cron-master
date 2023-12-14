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

export type SchedulerType = {
    uuid: string;
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

export type CronLogType = {
    uuid: string;
    scheduler_id: number;
    started_at: string;
    ended_at: string;
    cron_status_id: number;
    exception?: {
        message: string;
        trace: string;
    };
    created_at: string;
    updated_at: string;
    status: {
        id: number;
        color: string;
        label: "Draft" | "Running" | "Completed" | "Failed";
        description: string;
    };
    scheduler: {
        uuid: string;
        name: string;
        description: string;
        is_active: boolean;
        cron_job_class: string;
        timezone: string;
        notifiable_emails: Array<string>;
        notify_on_slack: boolean;
        deleted_at: string;
        created_at: string;
        updated_at: string;
    };
};
