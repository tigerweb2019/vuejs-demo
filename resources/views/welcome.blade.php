<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-bind="http://www.w3.org/1999/xhtml"
      xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <style>
        .bd-example {
            padding: 1.5rem;
            margin-right: 0;
            margin-left: 0;
            border: .2rem solid #f7f7f9;
        }

        body {
            background: none;
        }

        .highlight {
            padding: 1.5rem;
            margin-right: 0;
            margin-left: 0;
            background-color: #f7f7f9;
        }

        .answer-content p {
            margin-bottom: 0;
        }

        .game-main {
            padding: 10px;
            margin-bottom: 10px;
            background: #fff;
        }

        .box-price {
            background: #5aab61;
            color: #fff;
            padding: 2px 10px;
            border-radius: 24px 24px 24px 24px;
            border: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div id="app" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="bd-example">
                    <div class="form-group">
                        <label for="keyword">Nội dung tìm kiếm</label>
                        <input v-on:keyup.enter="search" v-model="term" type="text" class="form-control" id="keyword"
                               placeholder="Nhập nội dung cần tìm kiếm">
                    </div>
                    <button @click="search" type="submit" class="btn btn-primary">
                        <span class="fa fa-search" v-bind:class="{ 'fa-spinner fa-spin' : searching }"></span>
                        Tìm kiếm
                    </button>
                </div>
                <div class="highlight">
                    <div v-for="(result, index_re) in results" class="game-main">
                        <div class="game-number">
                            <span>
                                <b>
                                    Kết quả @{{ index_re+1 }}
                                </b>
                            </span>
                        </div>
                        <div class="game-content">
                            <div v-html="result.title"></div>
                            <div class="clearfix"></div>
                            <div class="game-explain hidden">
                                <div class="col-xs-12" style="color: #808080">
                                    <span>
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span>@{{ result.time }}</span> phút
                                    </span>
                                    <span>
                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                        <span>@{{ result.number_question }}</span> câu hỏi
                                    </span>
                                    <button style="" class="box-price">
                                        @{{ result.price ? result.price.toLocaleString()+' đ' :'Miễn phí' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div style="font-size:13px; margin-top:10px;text-align: right;">
                            <span>
                                <a v-bind:href="/room/+result.slug" class="error-show">
                                    <span>
                                        <i class="fa fa-sign-in"></i>
                                        Thi ngay
                                    </span>
                                </a>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let myApp = new Vue({
        el: '#app',
        data: {
            term: '',
            results: [],
            noResults: false,
            searching: false
        },
        methods: {
            search: function () {
                this.searching = true;
                fetch(`http://localhost:8000/api/v1/exams?term=${encodeURIComponent(this.term)}`)
                    .then(res => res.json())
                    .then(res => {
                        this.searching = false;
                        this.results = res;
                        this.searching = false
                    });
            }
        }
    })
</script>

</body>
</html>
