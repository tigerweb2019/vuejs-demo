<?php

use App\Exam;

/* @var $exam Exam */

?>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/exam.css')}}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <style>
        body {
            background-color: #f0f0f0;
        }

        .answer-content p {
            margin-bottom: 0;
        }

        .answer-key {
            margin-left: 10px;
            font-weight: bold;
            color: #4f4f4f !important;
        }

        .answer-content {
            padding: 5px;
            cursor: default;
            font-size: 1.1em;
        }

        .game-main {
            padding: 10px;
            margin-bottom: 10px;
            background: #fff;
        }

        .answer-sticky {
            position: sticky;
            position: -webkit-sticky;
            top: 10px;
        }
    </style>
</head>
<body>

<div id="app" style="margin-top: 50px;">
    <div v-if="loading" class="container box-loading">
        <div class="row">
            <div class="col-md-12">
                <div class="box-thumbnail"></div>

                <div class="box-line-sm"></div>
                <div class="box-line-xs"></div>

                <div class="box-line-df"></div>
                <div class="box-line-lgx"></div>
                <div class="box-line-lg"></div>
            </div>
        </div>
    </div>
    <div v-if="!loading" class="container clearfix box">
        <div class="row">
            <div class="col-md-12">
                <div class="exam-mondai-title">
                    <div class="horizotalMenuItemFinal">
                        <h3>@{{ exam.title }}</h3>
                    </div>
                    <div class="heading-line"></div>
                </div>
            </div>
        </div>
        <div class="row" id="action-scroll">
            <div class="col-md-9 answer-sticky">
                <div class="basic-game-view-main-panel">
                    <div class="leftMenuGame basic-game-view-left-panel">
                        <div class="this_is_main_scroll_panel_in_basic_game_view scroll-style">
                            <div class="game-content-panel" v-for="(result,key_re) in results">
                                <div class="row" :id="'question-'+result.id">
                                    <div class="col-md-12">
                                        <div class="game-main">
                                            <div class="game-number">
                                                <span><b>Câu @{{ key_re+1 < 10 ? 0:'' }}@{{ key_re+1 }}</b></span>
                                            </div>
                                            <div class="game-content">
                                                <div v-html="result.content"></div>
                                                <div class="clearfix"></div>
                                                <div v-for="(answer,key_an) in JSON.parse(result.answer)">
                                                    <div class="col-md-12" style="margin: 5px 0;">
                                                        <table @click="setAnswer(result.id,key_an)"
                                                               :class="myStyle[result.id][key_an]" class="tp-checkbox">
                                                            <tbody>
                                                            <tr>
                                                                <td style="padding-left: 10px;width: 60px;">
                                                                <span class="fa fa-circle-o">
                                                                    <span class="answer-key">@{{ key_an }}.</span>
                                                                </span>
                                                                </td>
                                                                <td>
                                                                    <div v-html="answer" class="answer-content"></div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div style="font-size:13px; margin-top:10px;text-align: right;">
                                                <span>
                                                    <a href="" class="error-show">
                                                        <span>
                                                            <i class="fa fa-exclamation-circle"></i> Báo sai sót
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
                </div>
            </div>
            <div class="col-md-3 hidden-xs hidden-sm">
                <div class="game-answer-panel position-sticky">
                    <div class="game-time-header">
                        <div class="game-time-label">
                            <span>Thời gian còn lại</span>
                        </div>
                        <div class="game-countdown">
                            <div class="clock-h">@{{ hour }}</div>
                            <div class="clock-2dot">:</div>
                            <div class="clock-i">@{{ minute }}</div>
                            <div class="clock-2dot">:</div>
                            <div class="clock-s">@{{ second }}</div>
                            <div class="clearfix"></div>
                            <div class="clock-label">Giờ</div>
                            <div class="clock-text">:</div>
                            <div class="clock-label">Phút</div>
                            <div class="clock-text">:</div>
                            <div class="clock-label">Giây</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="game-answer-checkbox">
                        <div v-for="(result,key_re) in results">
                            <div class="answer-list">
                                <div class="answer pull-left">
                                    <div class="answer-text" :class="{'div-answered': result.id in listAnswer}">
                                        <span>@{{ key_re+1 < 10 ? 0:'' }}@{{ key_re+1 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div style="background: #fff">
                        <div class="game-end">
                            <button type="button" class="btn btn-primary"
                                    style="width: calc(100% - 94px);background: #428bca;" data-toggle="modal"
                                    data-target="#myModal">
                                Nộp bài
                            </button>
                            <a class="btn btn-outline-secondary" href="">Thoát</a>
                        </div>
                        <div class="game-preview" style="border-top: 1px solid #ccc;">
                            <div class="answered">
                                <div class="answer pull-left">
                                    <div class="answer-text" style="background: #2f70dc;"></div>
                                </div>
                                <div class="">
                                    <span>Đã trả lời</span>
                                    <div class="pull-right">
                                        <span class="count-preview">
                                            <span>@{{ answered }}</span>/@{{ totalQuestion }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="answered">
                                <div class="answer pull-left">
                                    <div class="answer-text"></div>
                                </div>
                                <div class="">
                                    <span>Chưa trả lời</span>
                                    <div class="pull-right">
                                        <span class="count-preview">
                                            <span>@{{ totalQuestion-answered }}</span>/@{{ totalQuestion }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 20px 0;">
                        <a href="/" class="btn btn-default" style="width: 100%;border-radius: 3px!important;">
                            <span class="fa fa-arrow-circle-left"></span>
                            Quay lại trang tìm kiếm
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div id="game-answer-panel-mobile" class="modal fade" role="dialog">
                <div class="modal-dialog" style="margin: 10px 0;">
                    <div class="modal-content">
                        <div class="game-answer-panel">
                            <div class="game-time-header">
                                <div class="game-time-label">
                                    <span>Thời gian còn lại</span>
                                </div>
                                <div class="game-countdown">
                                    <div class="clock-h">@{{ hour }}</div>
                                    <div class="clock-2dot">:</div>
                                    <div class="clock-i">@{{ minute }}</div>
                                    <div class="clock-2dot">:</div>
                                    <div class="clock-s">@{{ second }}</div>
                                    <div class="clearfix"></div>
                                    <div class="clock-label">Giờ</div>
                                    <div class="clock-text">:</div>
                                    <div class="clock-label">Phút</div>
                                    <div class="clock-text">:</div>
                                    <div class="clock-label">Giây</div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="game-answer-checkbox">
                                <div v-for="()">
                                    <div class="answer-list">
                                        <div class="answer pull-left">
                                            <div class="answer-text">
                                                <span>01</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="game-end">
                                    <button type="button" class="btn btn-primary"
                                            style="width: calc(100% - 94px);background: #428bca;" data-toggle="modal"
                                            data-target="#myModal">
                                        Nộp bài
                                    </button>
                                    <a class="btn btn-outline-secondary" data-dismiss="modal">Thoát</a>
                                </div>
                                <div class="game-preview" style="border-top: 1px solid #ccc;margin-top: 10px;">
                                    <div class="answered">
                                        <div class="answer pull-left">
                                            <div class="answer-text" style="background: #2f70dc;"></div>
                                        </div>
                                        <div class="">
                                            <span>Đã trả lời</span>
                                            <div class="pull-right">
                                                <span class="count-preview">
                                                    <span v-bind="answered">0</span>/60
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="answered">
                                        <div class="answer pull-left">
                                            <div class="answer-text"></div>
                                        </div>
                                        <div class="">
                                            <span>Chưa trả lời</span>
                                            <div class="pull-right">
                                                <span class="count-preview">
                                                    <span>60</span>/60
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
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
            hour: '00',
            minute: '00',
            second: '00',
            seconds: 0,
            answered: 0,
            listAnswer: {},
            classAnswer: {
                default: 'answer-default',
                chosen: 'answer-chosen'
            },
            myStyle: {},
            myClass: {},
            myStylePreview: {},
            totalQuestion: 0,
            exam: [],
            results: [],
            noResults: false,
            loading: true,
        },
        mounted: function () {
            this.search();
        },
        methods: {
            search: function () {
                this.searching = true;

                fetch(`http://localhost:8000/api/v1/exams?exam_id=<?= $exam['id'] ?>`)
                    .then(res => res.json())
                    .then(res => {
                        this.exam = res;
                        this.totalQuestion = res.number_question;
                        this.seconds = res.seconds;

                        fetch(`http://localhost:8000/api/v1/questions?exam_id=<?= $exam['id'] ?>`)
                            .then(res => res.json())
                            .then(res => {
                                this.results = res;
                                this.loading = false;

                                for (let i = 0; i < res.length; i++) {
                                    this.myStyle[res[i].id] = [];
                                    this.myStyle[res[i].id]['A'] = this.classAnswer.default;
                                    this.myStyle[res[i].id]['B'] = this.classAnswer.default;
                                    this.myStyle[res[i].id]['C'] = this.classAnswer.default;
                                    this.myStyle[res[i].id]['D'] = this.classAnswer.default;
                                }

                                this.ctrl();
                            });
                    });
            },
            ctrl: function () {
                window.setInterval(() => {
                    this.hour = Math.floor(this.seconds / 3600) >= 10 ? Math.floor(this.seconds / 3600) : '0' + Math.floor(this.seconds / 3600);

                    this.minute = Math.floor((this.seconds - this.hour * 3600) / 60) >= 10 ? Math.floor((this.seconds - this.hour * 3600) / 60) : '0' + Math.floor((this.seconds - this.hour * 3600) / 60);

                    this.second = (this.seconds % 60) >= 10 ? this.seconds % 60 : '0' + (this.seconds % 60);

                    if (this.seconds === 0) {
                        return true;
                    } else {
                        this.seconds--;
                    }
                }, 1000);
            },
            setAnswer: function (id, answer) {
                if (!(id in this.listAnswer)) {
                    this.answered++;
                }

                this.listAnswer[id] = answer;

                this.setStyleAnswer(id, answer);
            },
            setStyleAnswer: function (id, answer) {
                for (let prop in this.myStyle[id]) {
                    this.myStyle[id][prop] = this.classAnswer.default;

                    if (prop === answer) {
                        this.myStyle[id][prop] = this.classAnswer.chosen;
                    }
                }
            },
        }
    })
</script>

</body>
</html>
