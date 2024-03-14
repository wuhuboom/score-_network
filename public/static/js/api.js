var _rst = _rst || {}
var _api = _api || {}

var requesting = false;

Object.assign(_rst, {
    base({ url, type, data, success, fail, isanonymous = false }) {
        let headers = {
            'Content-Type': 'application/x-www-form-urlencoded',
        }

        if (isanonymous === false) {
            let accessToken = localStorage.getItem("accessToken")
            if (accessToken) {
                headers["token"] = accessToken;
            } else {
                this.page401();
                return;
            }
        } else {
            let accessToken = localStorage.getItem("accessToken")
            if (accessToken) {
                headers["token"] = accessToken;
            }
        }

        let reqObj = {
            url,
            type,
            crossDomain: true,
            headers,
            success(res) {
                if (res.code === 1001) {
                    toast('', res.msg, 'noLog', 2000, 1);
                    window.setTimeout(function () {
                        window.open('./login.html', "_top", "noreferrer");
                    }, 2000);
                } else {
                    if (success) {
                        success(res);
                    }
                }
            },
            error(res) {
                if (fail) {
                    fail(res);
                }
            }
        }

        if (data) {
            reqObj.data = data
        }

        $.ajax(reqObj)
    },
    get(reqobj) {
        reqobj.type = 'get'
        this.base(reqobj)
    },
    post(reqobj) {
        reqobj.type = 'post'
        this.base(reqobj)
    },
    page401() {
        toast('', "ไม่ได้เข้าสู่ระบบหรือบัญชีของคุณได้เข้าสู่ระบบที่อื่นแล้ว", 'noLog', 2000, 1);
        // window.setTimeout(function () {
        //     window.open('./login.html', "_top", "noreferrer");
        // }, 2000);
    }
});


Object.assign(_api, {
    proxyUrl: "https://api.ratchshare.com",
    // proxyUrl: "http://127.0.0.1",
    reqUrl(path) {
        return this.proxyUrl + path;
    },
    sendSMS(mobile, sms_type, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/sms.send"),
                data: {
                    "mobile": mobile,
                    "sms_type": sms_type,
                },
                isanonymous: true,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    register(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/register.do"),
                data: data,
                isanonymous: true,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    login(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/login.do"),
                data: data,
                isanonymous: true, //不需要登录授权true
                success(res) {
                    requesting = false;
                    callback && callback(res)
                }
            });
        }
    },
    visitInvest(callback) {
        _rst.get({
            url: this.reqUrl("/invest.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitPassword(callback) {
        _rst.get({
            url: this.reqUrl("/password.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    resetLoginPassword(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/password/login.reset"),
                data: data,
                isanonymous: true, //不需要登录授权true
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    changeLoginPassword(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/password/login.change"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    setTradePassword(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/password/trade.set"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    resetTradePassword(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/password/trade.reset"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    changeTradePassword(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/password/trade.change"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    visitHome(callback) {
        _rst.get({
            url: this.reqUrl("/home.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitMy(callback) {
        _rst.get({
            url: this.reqUrl("/my.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitOrder(callback) {
        _rst.get({
            url: this.reqUrl("/order.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    getOrder(id, callback) {
        _rst.get({
            url: this.reqUrl("/order.get?id=" + id),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitProduct(callback) {
        _rst.get({
            url: this.reqUrl("/product.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitTask(callback) {
        _rst.get({
            url: this.reqUrl("/task.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitMessage(callback) {
        _rst.get({
            url: this.reqUrl("/message.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    viewMessage(id, callback) {
        _rst.get({
            url: this.reqUrl("/message.view?id=" + id),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitLuckyTurntable(callback) {
        _rst.get({
            url: this.reqUrl("/luckyTurntable.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    startLuckyTurntable(callback) {
        if (!requesting) {
            requesting = true;

            _rst.get({
                url: this.reqUrl("/luckyTurntable.start"),
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    openTreasureChest(key, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/treasure_chest.open"),
                data: {
                    "treasure_chest_key": key
                },
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    dailyAttendance(callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/dailyAttendance.do"),
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    invitationActivation(callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/invitationActivation.receive"),
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    awardCollection(data, callback) {
        if (!requesting) {
            requesting = true;
            _rst.post({
                url: this.reqUrl("/taskActive.receive"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    visitEarnings(callback) {
        _rst.get({
            url: this.reqUrl("/earnings.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    collectProductGive(callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/giveProduct.collect"),
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    visitInvite(callback) {
        _rst.get({
            url: this.reqUrl("/invite.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitTeam(callback) {
        _rst.get({
            url: this.reqUrl("/team.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    listTeamLevel1(page, callback) {
        _rst.get({
            url: this.reqUrl("/team/level1.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    listTeamLevel2(page, callback) {
        _rst.get({
            url: this.reqUrl("/team/level2.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    listTeamLevel3(page, callback) {
        _rst.get({
            url: this.reqUrl("/team/level3.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitMine(callback) {
        _rst.get({
            url: this.reqUrl("/mine.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitDeposit(callback) {
        _rst.get({
            url: this.reqUrl("/deposit.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    getDeposit(id, callback) {
        _rst.get({
            url: this.reqUrl("/deposit.get?id=" + id),
            success(res) {
                callback && callback(res);
            }
        });
    },
    deposit(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/deposit.do"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    depositList(page, callback) {
        _rst.get({
            url: this.reqUrl("/deposit.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitWithdraw(callback) {
        _rst.get({
            url: this.reqUrl("/withdraw.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    getWithdraw(id, callback) {
        _rst.get({
            url: this.reqUrl("/withdraw.get?id=" + id),
            success(res) {
                callback && callback(res);
            }
        });
    },
    withdraw(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/withdraw.do"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    withdrawList(page, callback) {
        _rst.get({
            url: this.reqUrl("/withdraw.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    earningsList(page, callback) {
        _rst.get({
            url: this.reqUrl("/earnings.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    rewardList(page, callback) {
        _rst.get({
            url: this.reqUrl("/reward.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    commissionList(page, callback) {
        _rst.get({
            url: this.reqUrl("/commission.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    bankList(callback) {
        _rst.get({
            url: this.reqUrl("/bank.list"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    bankCardAdd(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/bankCard.add"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    bankCardDelete(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/bankCard.delete"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    visitBankCard(callback) {
        _rst.get({
            url: this.reqUrl("/bankCard.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    order(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/order.do"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    balanceDetailList(page, callback) {
        _rst.get({
            url: this.reqUrl("/balanceDetail.list?page=" + page),
            success(res) {
                callback && callback(res);
            }
        });
    },
    information(callback) {
        _rst.get({
            url: this.reqUrl("/information.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    updateInformation(data, callback) {
        if (!requesting) {
            requesting = true;

            _rst.post({
                url: this.reqUrl("/information.update"),
                data: data,
                success(res) {
                    requesting = false;
                    callback && callback(res);
                }
            });
        }
    },
    visitBulletin(callback) {
        _rst.get({
            url: this.reqUrl("/bulletin.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    getBulletin(id, callback) {
        _rst.get({
            url: this.reqUrl("/bulletin.get?id=" + id),
            success(res) {
                callback && callback(res);
            }
        });
    },
    getProduct(id, callback) {
        _rst.get({
            url: this.reqUrl("/product.get?id=" + id),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitVip(callback) {
        _rst.get({
            url: this.reqUrl("/vip.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitWallet(callback) {
        _rst.get({
            url: this.reqUrl("/wallet.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitSpread(callback) {
        _rst.get({
            url: this.reqUrl("/spread.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    visitService(callback) {
        _rst.get({
            url: this.reqUrl("/service.visit"),
            success(res) {
                callback && callback(res);
            }
        });
    },
    publishBlog(data, callback) {
        _rst.post({
            url: this.reqUrl("/blog.publish"),
            data: data,
            success(res) {
                callback && callback(res);
            }
        })
    },
    listBlog(page, callback) {
        _rst.post({
            url: this.reqUrl("/blog.list"),
            data: {
                "page": page
            },
            success(res) {
                callback && callback(res);
            }
        })
    }
});
