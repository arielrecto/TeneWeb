import axios from "axios";
import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("lineChart", () => ({
    chart: null,
    init() {
        const chartElement = this.$refs.chart;

        var options = {
            series: [
                {
                    name: "Desktops",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
                },
            ],
            chart: {
                height: 350,
                type: "line",
                zoom: {
                    enabled: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "straight",
            },
            title: {
                text: "Product Trends by Month",
                align: "left",
            },
            grid: {
                row: {
                    colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                    opacity: 0.5,
                },
            },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                ],
            },
        };

        this.chart = new ApexCharts(chartElement, options);
        this.chart.render();
    },
}));

Alpine.data("imagePreview", () => ({
    imageSrc: null,
    uploadImageHandler(e) {
        const { files } = e.target;

        const reader = new FileReader();

        reader.onload = () => {
            this.imageSrc = reader.result;
        };

        reader.readAsDataURL(files[0]);
    },
}));

Alpine.data("textEditor", () => ({
    descriptions: null,
    quillInstance: null,
    init() {
        const editor = this.$refs.editor;

        console.log("Hello world");

        this.quillInstance = new Quill(editor, {
            theme: "snow",
        });


        this.quillInstance.on('text-change', () => {
            this.descriptions = this.quillInstance.root.innerHTML

        });

    },

    getContent() {
        const content = this.quillInstance.root.innerHTML;

        this.descriptions = content;

        console.log(this.descriptions);
    },
}));

Alpine.data("pieChart", () => ({
    chart: null,
    init() {
        const chartElement = this.$refs.chart;
        var options = {
            series: [44, 55],
            chart: {
                width: 380,
                type: "pie",
            },
            labels: ["Occupied", "Available"],
            responsive: [
                {
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200,
                        },
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            ],
        };

        this.chart = new ApexCharts(chartElement, options);
        this.chart.render();
    },
}));

Alpine.data("getRoomByTenement", () => ({
    rooms: [],
    isLoading: false,
    tenementId: null,
    init() {
        this.$watch("tenementId", () => {
            if (!this.tenementId) return;
            console.log('====================================');
            console.log('hello world');
            console.log('====================================');
            this.getRoom();
        });
    },
    async getRoom() {
        try {
            this.isLoading = true;

            const response = await axios.get(
                `/pre-register/tenement/${this.tenementId}/rooms`
            );

            this.rooms = [...response.data.rooms];
        } catch (error) {
            console.log("====================================");
            console.log(error);
            console.log("====================================");
        } finally {
            this.isLoading = false;
        }
    },
}));


Alpine.start();
