<template>
    <div>
        <div class="container">
            <button @click.prevent="newSpiral()">CLICK ME</button>
            <div class="spiral-container">
                <p id="spiral"></p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        display: "",
        randoms: {
            id: []
        },
        breakdowns: {
            datas: [],
            id: []
        },
        datas: [],
        newRandomSet: [],
        newBreakdownSet: [],
        counter: 1
    }),
    methods: {
        newSpiral() {
            let charset = "abcdefghijklmnopqrstuvwxyz1234567890";
            let charsLength = charset.length;
            let num1 = Math.round(Math.random() * (10 - 5) + 5);
            let num2 = Math.round(Math.random() * (10 - 5) + 5);
            this.breakdowns.datas = [];
            for (let x = 0; x < num1; x++) {
                let data = "";
                for (let y = 0; y < 5; y++) {
                    data += charset.charAt(
                        Math.floor(Math.random() * charsLength)
                    );
                }

                this.randoms.id.push(data);

                for (let a = 0; a < num2; a++) {
                    let data2 = "";

                    //generate 5 character string
                    for (let b = 0; b < 5; b++) {
                        data2 += charset.charAt(
                            Math.floor(Math.random() * charsLength)
                        );
                    }

                    let temp = {
                        id: data,
                        values: data2
                    };
                    this.breakdowns.datas.push(temp);
                }
            }
            this.axios.post(`/api/NewRandoms`, this.randoms).then(response => {
                if (response.data == "success") {
                    this.newBreakDowns();
                }
            });
        },
        newBreakDowns() {
            this.axios
                .post(`/api/NewBreakDowns`, this.breakdowns)
                .then(response => {
                    if (response.data == "success") {
                        this.GetSpiral();
                    }
                });
            location.reload();
        },
        GetSpiral() {
            this.axios.get(`/api/GetSpiral`).then(response => {
                this.newRandomSet = response.data;
                this.showSpiral();
            });
        },
        showSpiral() {
            this.display = "";
            for (let x = 0; x < this.newRandomSet.length; x++) {
                this.display += this.newRandomSet[x];
                for (let y = 0; y < this.newBreakdownSet.length; y++) {
                    if (
                        this.newRandomSet[x].id ==
                        this.newBreakdownSet[y].random_id
                    ) {
                        this.display += this.newBreakdownSet[y].name;
                    }
                }
            }
            spiral({
                target: document.getElementById("spiral"),
                span: 150, // percent
                north: 0, // cc rotate in percent
                spiral: true,
                size: 800,
                text: this.display
            });
        }
    },
    created() {
        this.GetSpiral();
    }
};
</script>
