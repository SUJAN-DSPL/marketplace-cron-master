import * as React from "react";

import { cn } from "@/lib/utils";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import { SchedulerFromInputsType } from "@/types";
import { FrequencyType } from "@/Components/hooks/use-scheduler";
import { Input } from "@/Components/ui/input";

interface FrequencySelectorProps extends React.HTMLAttributes<HTMLDivElement> {
    inputFrequency: SchedulerFromInputsType["frequencies"][0];
    frequencies: Array<FrequencyType> | undefined;
    setSchedulerFrequencies: React.Dispatch<
        React.SetStateAction<SchedulerFromInputsType["frequencies"]>
    >;
}

const FrequencySelector = React.forwardRef<
    HTMLDivElement,
    FrequencySelectorProps
>(
    (
        {
            inputFrequency,
            frequencies,
            setSchedulerFrequencies,
            className,
            children,
            ...props
        },
        ref
    ) => {
        const [frequency, setFrequency] = React.useState(inputFrequency);
        // const []

        return (
            <div
                ref={ref}
                className={cn("relative h-full", className)}
                {...props}
            >
                <Select value={`${frequency.frequency_id}`}>
                    <SelectTrigger
                        id="frequencies"
                        className="line-clamp-1  truncate"
                    >
                        <SelectValue placeholder="Select the  frequency" />
                    </SelectTrigger>

                    <SelectContent className=" h-[30vh]">
                        {frequencies &&
                            frequencies.map((frequency, index) => (
                                <SelectItem
                                    key={index}
                                    value={`${frequency.id}`}
                                >
                                    {frequency.label}
                                </SelectItem>
                            ))}
                    </SelectContent>
                </Select>

                <div>
                    {frequencies &&
                        frequencies
                            .filter(
                                (fre) => fre.id === frequency.frequency_id
                            )[0]
                            .param_details.map((param, index) => (
                                <div key={index}>
                                    <Input id="name" placeholder={param.name} />
                                </div>
                            ))}
                </div>
            </div>
        );
    }
);

FrequencySelector.displayName = "FrequencySelector";

export default FrequencySelector;
