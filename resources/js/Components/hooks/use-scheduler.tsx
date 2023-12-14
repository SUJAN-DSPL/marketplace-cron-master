import { UseQueryResult, useQuery } from "@tanstack/react-query";
import axios from "axios";

export type FrequencyType = {
    id: number,
    label: string;
    method: string;
    param_details: Array<{
        name: string;
        description: string;
    }>;
    description: string;
    is_active: boolean;
};

export const useScheduler = () => {
    const timezones = useQuery({
        queryKey: ["timezones"],
        queryFn: async () => (await axios.get(route("timezones"))).data,
    }) as UseQueryResult<Array<string>>;

    const cronJobs = useQuery({
        queryKey: ["cron-jobs"],
        queryFn: async () => (await axios.get(route("cron-jobs"))).data,
    }) as UseQueryResult<Array<string>>;

    const frequencies = useQuery({
        queryKey: ["frequencies"],
        queryFn: async () => (await axios.get(route("frequencies"))).data,
    }) as UseQueryResult<Array<FrequencyType>>;

    return {timezones, cronJobs, frequencies};
};
