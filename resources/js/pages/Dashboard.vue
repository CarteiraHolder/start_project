<template>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <dl class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div
                v-for="item in stats"
                :key="item.id"
                class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 border sm:px-6 sm:pt-6"
            >
                <dt>
                    <div
                        class="absolute border-gray-300 rounded-md bg-secondary p-3"
                    >
                        <component
                            :is="item.icon"
                            class="h-6 w-6 text-white"
                            aria-hidden="true"
                        />
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">
                        {{ item.name }}
                    </p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ item.stat }}
                    </p>
                    <p
                        :class="[
                            item.changeType === 'increase'
                                ? 'text-green-600'
                                : 'text-red-600',
                            'ml-2 flex items-baseline text-sm font-semibold',
                        ]"
                    >
                        <ArrowUpIcon
                            v-if="item.changeType === 'increase'"
                            class="h-5 w-5 flex-shrink-0 self-center text-green-500"
                            aria-hidden="true"
                        />
                        <ArrowDownIcon
                            v-else
                            class="h-5 w-5 flex-shrink-0 self-center text-red-500"
                            aria-hidden="true"
                        />
                        <span class="sr-only">
                            {{
                                item.changeType === "increase"
                                    ? "Increased"
                                    : "Decreased"
                            }}
                            by
                        </span>
                        {{ item.change }}
                    </p>
                </dd>
            </div>
        </dl>
        <div class="mt-6 border rounded-lg p-5">
            <div id="chart">
                <VueApexCharts
                    type="bar"
                    height="380"
                    :options="chartOptions"
                    :series="series"
                ></VueApexCharts>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import VueApexCharts from "vue3-apexcharts";

import { ArrowDownIcon, ArrowUpIcon } from "@heroicons/vue/20/solid";
import {
    CursorArrowRaysIcon,
    EnvelopeOpenIcon,
    UsersIcon,
} from "@heroicons/vue/24/outline";

const stats = [
    {
        id: 1,
        name: "Total Subscribers",
        stat: "71,897",
        icon: UsersIcon,
        change: "122",
        changeType: "increase",
    },
    {
        id: 2,
        name: "Avg. Open Rate",
        stat: "58.16%",
        icon: EnvelopeOpenIcon,
        change: "5.4%",
        changeType: "increase",
    },
    {
        id: 3,
        name: "Avg. Click Rate",
        stat: "24.57%",
        icon: CursorArrowRaysIcon,
        change: "3.2%",
        changeType: "decrease",
    },
    {
        id: 4,
        name: "Avg. Click Rate",
        stat: "24.57%",
        icon: CursorArrowRaysIcon,
        change: "3.2%",
        changeType: "decrease",
    },
];

const series = ref([
    {
        name: "sales",
        data: [
            {
                x: "2019/01/01",
                y: 400,
            },
            {
                x: "2019/04/01",
                y: 430,
            },
            {
                x: "2019/07/01",
                y: 448,
            },
            {
                x: "2019/10/01",
                y: 470,
            },
            {
                x: "2020/01/01",
                y: 540,
            },
            {
                x: "2020/04/01",
                y: 580,
            },
            {
                x: "2020/07/01",
                y: 690,
            },
            {
                x: "2020/10/01",
                y: 690,
            },
        ],
    },
]);

setInterval(() => {
    // console.log(series.value[0].data);
    series.value[0].data.forEach((element) => {
        element.y = parseInt(Math.random() * (2000 - 100) + 100);
    });
}, 10000);

const chartOptions = {
    colors: ["#081466"],
    chart: {
        type: "bar",
        height: 380,
    },
    xaxis: {
        type: "category",
        group: {
            style: {
                fontSize: "10px",
                fontWeight: 700,
            },
            groups: [
                { title: "2019", cols: 4 },
                { title: "2020", cols: 4 },
            ],
        },
    },
    title: {
        text: "Grouped Labels on the X-axis",
    },
    tooltip: {
        x: {
            formatter: function (val) {
                return (
                    "Q" + dayjs(val).quarter() + " " + dayjs(val).format("YYYY")
                );
            },
        },
    },
};
</script>
