<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="padding-top: 10px;">
    <div id="app">
        <div class="container">
            <div class="float-right">
                カートの中身： <span class="badge badge-pill badge-light" v-text="Object.keys(cartItems).length"></span> 個
            </div>
            <h1>商品一覧</h1>
            <div class="row">
                <div v-for="(product,index) in products" class="col-sm-4">
                    <div class="card border-info">
                        <div class="card-body">
                            <h5 class="card-title" v-text="product.name"></h5>
                            <p class="card-text">
                                <label>サイズ：</label>
                                <select ref="size" class="form-control">
                                    <option v-for="size in product.sizes" :value="size" v-text="size"></option>
                                </select>
                            </p>
                            <p class="card-text">
                                <label>個数：</label>
                                <input ref="qty" type="number" class="form-control" min="0" value="0">
                            </p>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-info" @click="addCart(index)">カートへ入れる</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>

        new Vue({
            el: '#app',
            data: {
                products: [],
                cartItems: {}
            },
            methods: {
                addCart: function(index) {

                    if(confirm('カートへ追加します。よろしいですか？')) {

                        var self = this;
                        var product = this.products[index];
                        var size = this.$refs.size[index].value;
                        var qty = this.$refs.qty[index].value;

                        var url = '/ajax/carts';
                        var params = {
                            product_id: product.id,
                            size: size,
                            qty: qty
                        };
                        axios.post(url, params)
                            .then(function(response){

                                self.cartItems = response.data;

                            });

                    }

                },
                getProducts: function() {

                    var self = this;
                    axios.get('/ajax/products')
                        .then(function(response){

                            self.products = response.data;

                        });

                },
                getCarts: function() {

                    var self = this;
                    axios.get('/ajax/carts')
                        .then(function(response){

                            self.cartItems = response.data.items;

                        });

                }
            },
            mounted: function() {

                this.getProducts();
                this.getCarts();

            }
        });

    </script>
</body>
</html>