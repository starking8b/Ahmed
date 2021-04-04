

var Users = function () {


    var userTable = $('#ispuser-table');

    var tdDetails = [];
    var searchBtn = $('#searchBtn');
    var clearBtn = $('#clearBtn');


    var selectedPage = 1; //default
    var pagingTotalCount = 8; //default
    var lastFilterObject = "";
    var deviceSelect = $('#deviceselect');
    var pageLenghtSelect = $('#logTable_length');
    var usersTable = $('#ispuser-table');
    var contextSearch = $('#context-search');
    var contextAddfilter = $('#context-addfilter');
    var contextPaste = $('#context-paste');
    var contextPasteSearch = $('#context-pastesearch');
    var addAsColumn = $('#add-as-column')

    var exportCsvBtn = $('#exportCsvBtn');
    var csvStartPage = $('#csvStartPage');
    var csvEndPAge = $('#csvEndPage');
    var csvTotalPage = $('#csvTotalPages');
    var globalInterval = $('#globalInterval');
    //global vars
    var l = 1//lang.logs.index;
    var currentLang = l;
    var counterStat = { ready: 0, loading: 1 };
    var cStatus;

    var pageLenght = 10;
    var logtype = 'all';
    var logFields = [];
    var TaskId = 0; //pagecount kontrolü için gerekli.
    var countIntervalFunc; //pagecount kontrolü için gerekli.
    var contextValue = "";
    var contextColumn = "";
    var lastFocusedInput = "";
    var daterangeSearch = false;
    var firstDateRangeSearch = true;
    var autoRefreshRequest = false;

    var paging = pageLenght;
    var columns = [];
    var rows = [];
    var lastrowNumber = 0;
    var isCsvCancel = false;
    var unfilterarray=['password','owner','address','Created at']

    var selectedFilterArr=['online_status','username','password'];

    var shiftColumnName = [  ];
    var shiftColumn = 0; //gizlenmiş sütunlar için soldan sağa kaç adet kaydırma yapılacağını belirler.
    if (localStorage.getItem("fields") !== null) {
        selectedFilterArr=JSON.parse(localStorage.getItem("fields"));

    }
      var newelemnt='online_status';
    // selectedFilterArr=  [newelemnt].concat(selectedFilterArr)
   // selectedFilterArr.push('online_status')

    function getPackages() {
        var device = $('#deviceselect').val();
        $.ajax({
            async: false,
            type: 'GET',
            url: '/Users/GETPlans',
            data :{deviceId:device},
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            success: OnSuccess,
            error: OnError
        })

        function OnSuccess(data) {

            datad = [];
            //data=data[0];
            var profilename;
            for(i=0;i<data.length;i++){
                profilename=data[i]['groupname']

                datad.push({ id: profilename, text: profilename })

            }



            profileSelect.select2({
                placeholder: 'Select Package',
                allowClear: true,
                data: datad
            });

        }

        function OnError(data) {alert('error')
            console.log(data)
        };


    }



    function deleteopenRow(tdDetails) {

        var table = userTable.DataTable();
        tdDetails.forEach(function (tdd) {

            var tr = tdd.closest('tr');
            var row = table.row(tr);
            row.child.remove();
            tr.removeClass('shown');

        })
        tdDetails = [];

    };

    //filter process
    function runFilter(oTable) {


        var a = userTable.children('thead').children('tr').children('th');

        userTable.children('thead').children('input').remove();

        $.each(oTable.fnSettings().aoColumns, function (key, value) {

            var th = $(value.nTh);
            var thName = $(value.nTh).attr('data-headname');

            var thExampleText = $(value.nTh).data('exampletext');
            var thIsSelect = $(value.nTh).data('isselect');

            if (thName != null) {




                    var filterInput = '<input data-name="' + thName + '" style="margin-right:1px; float:left; margin-top: 4px;" placeholder="filter ex.: ' + thExampleText + '" class="filterinput input-sm form-control form-control-inline input' + thName + ' " size="16" type="text" value="' + getLastFilterVal(thName) + '">';

                    var filterdropdown = '<div class="dropdown inline clearfix drwrapper" >' +

                        '<ul class="dropdown-menu" role="menu">' +
                        '<li role="presentation" class="" data-isselect="' + thIsSelect + '" data-name="' + thName + '">' +




                        '</li>' +
                        '</ul>' +

                        '</div>';

                    th.append(filterInput);
                    th.append(filterdropdown);

            }

        });

        $('[data-toggle="popover"]').popover();
        $('.inputtime').click(function () {

            $('[data-toggle="popover"]').popover();
            var latestval = $('.inputtime').val();
            if (latestval != '') {
                try {

                    var latestsplit1 = latestval.split('-');
                    var latestsplit2 = latestsplit1[0].split(':');
                    var latestsplit3 = latestsplit1[1].split(':');

                    $('#starthourtime').val(latestsplit2[0]);
                    $('#endhourtime').val(latestsplit3[0]);

                } catch (e) {
                    $('#starthourtime').val(0);
                    $('#endhourtime').val(24);
                }
            }
            else {
                $('#starthourtime').val(0);
                $('#endhourtime').val(24);
            }





        });


    }

    //get the last time filter values
    function getLastFilterVal(headerName) {

        var lfilters = "";
        if (lastFilterObject != "") {
            lfilters = JSON.parse(lastFilterObject);

        };

        var rval = "";

        $.each(lfilters, function (key, value) {

            if (key == headerName) {


                rval = value;
            }
        });

        return rval;

    }

    //paging count set
    function setPagingCount(pagingTotalCount) {
        $('#pageCounter').twbsPagination('destroy');
        //Pagination Click
        $('#pageCounter').twbsPagination({
            totalPages:pagingTotalCount,
            visiblePages: pagingTotalCount,
            prev: 'Prev',
            first: null,
            last: null,
            startPage: selectedPage,
            onPageClick: function (event, page) {
                selectedPage = page
                $('#searchBtn').trigger("click");
                $('.pagination').find('li').addClass('page-item');
                $('.pagination').find('a').addClass('page-link');
            }
        });
        $('.multsi').multi_select({
            selectColor: 'purple',
            selectSize: 'small',
            selectText: 'Select Columns',

            easing: 'slide',
            listMaxHeight: 300,
            selectedCount: 2,

            fillButton: true,
            selectedIndexes:  1 ,
            data: {
                "username": "Username",
                "password": "Password",

                "phone": "Phone",
                "email": "Email",
                "created_at": "Created at",
                "owner" :"Owner",
                "address": "Address",
                "mac": "Mac Address",
                "profile": "Profile",


            },
            onSelect: function (value ) {

                if (value.length) {
                    value=  [newelemnt].concat(value)
                    localStorage.setItem('fields',JSON.stringify(value));
                    selectedFilterArr=value;
                }

            },
        });

        $('#get_values').on('click', function(event) {

            $('.data-display').remove();
            var json = { items: $('#multi').multi_select('getSelectedValues') };
            if (json.items.length) {
                var ul = $('<ul>', { 'class': 'data-display' }).appendTo('body');
                $(json.items).each(function(index, item) {
                    ul.append(
                        '<li style="display: block;">' + item + '</li>'
                    );
                });
            }
        })

        // $('#pageCounter').bootpag({
        //     total: pagingTotalCount,
        //     page: selectedPage,
        //     maxVisible: 10,
        //     leaps: true,
        //     firstLastUse: true,
        //     first: '←',
        //     last: '→',
        //     wrapClass: 'pagination',
        //     activeClass: 'active',
        //     disabledClass: 'disabled',
        //     nextClass: 'next',
        //     prevClass: 'prev',
        //     lastClass: 'last',
        //     firstClass: 'first'
        // });

    }

    //get filter input val and headnme
    function getFilterVal() {

        var date = $('#sidebarDate').val();
        var a = userTable.children('thead').children('tr').children('th').children('input');
        var filter = [];
        var filtersObj = '{"' + $(a[0]).attr('data-name') + '":"' + $(a[0]).val() + '"';

        // filtersObj += ',"date":"' + date.replace(/'/g, '') + '"'
        if (logtype != "all") {
            filtersObj += ',"subtype":"' + logtype.replace(/'/g, '') + '"'
        }

        for (var i = 1; i < a.length; i++) {

            var b = inputName = $(a[i]).attr('data-name');
            var c = inputVal = $(a[i]).val();
            if (inputVal != "") {

            }
            //remove "comma"
            filtersObj += ',"' + b + '":"' + c.replace(/'/g, '').replace(/,\s*$/, "") + '"'

        }
        filtersObj += '}';

        return filtersObj;
    }

    //col/head visble prop
    function visColumn(headparam, oTable) {

        var headName = headparam.attr("data-headname");
        var iCol = logTable.DataTable().column('#' + headName + '').index();



            try {

                if (headparam.attr('data-checked') == 'true') {
                    headparam.attr('data-checked', 'false');
                    headparam.children().children().children().attr('class', 'fa fa-times');
                    headparam.children().children().children().parent().attr('class', 'btn red btn-xs');
                    oTable.fnSetColumnVis(iCol, (false));
                }
                else {

                    headparam.attr('data-checked', 'true');
                    headparam.children().children().children().attr('class', 'fa fa-check');
                    headparam.children().children().children().parent().attr('class', 'btn blue btn-xs'); status = true;
                    oTable.fnSetColumnVis(iCol, (true));

                }

            } catch (e) {



            }



        if (!daterangeSearch) {
            //re-search
            searchBtn.trigger("click");
        }
        else {
            firstDateRangeSearch = true;
            emptyData();
            var warningText = $('#logTable').find('tbody tr td');
            warningText.text(l.date_range_search_is_ready_pls_set_filter_and_click_search_btn);
        }

    }

    //get column index id


    //all log fields
    function getLogFields() {
        $.ajax({
            async: true,
            type: 'GET',
            url: '/User/getselected',
            data: "{}",
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            success: function (data) {

                logFields = data;

            },
            error: function (data) {

            }
        });

    }

    //get page count
    function getPageCount( ) {
        var device = $('#deviceselect').val();




        var filtersStr = getFilterVal();

        var pageNumber = selectedPage;


        if (lastFilterObject != '') {
            if (lastFilterObject != filtersStr) {
                pageNumber = 1;
                selectedPage = 1;
            }
        }
        lastFilterObject = filtersStr;
        var paging = pageLenght;

        //setpage count


        $('.rowcount').hide();
        $('.timer').hide();
        clearInterval(countIntervalFunc);

        function getdata() {

            //getpage count
            _pagingTotalCount = 1;

            $('.rowcount').fadeIn();
            $('.timer').fadeIn();
            $.ajax({
                async: true,
                type: 'GET',
                url: '/ISP/getPageCountusers',
                data: {_logfields:selectedFilterArr,_filters:filtersStr   ,device:device, _paging: paging },
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                success: function (data) {

                    if (data.PagingCount != -1) {

                        //   if (data.TaskId != TaskId) {
                        clearInterval(countIntervalFunc);
                        pagingTotalCount = data.PagingCount;
                        setPagingCount(pagingTotalCount);
                        var count = (pageLenght * pagingTotalCount);
                        $('.rowcount').text(count + " " + 'Rows');

                        var _pagingTotalCount = pagingTotalCount;
                        if (_pagingTotalCount < 1) {
                            _pagingTotalCount = 1;
                        }

                        csvTotalPage.text(' ' + _pagingTotalCount );
                        TaskId = data.TaskId;
                        $('.rowcount').fadeIn();
                        $('.timer').fadeIn();
                        //  }
                        cStatus =1; //unterStat.ready;

                    }
                    else {
                        cStatus =0;//erStat.loading;
                        alert(cStatus)
                    }
                }
            });
        }
      //  countIntervalFunc = setInterval(getdata, 1000);
        getdata()



    }

    //right click menu context
    function contextMenu() {

        $('#ispuser-table_wrapper thead').contextmenu({
            target: '#context-menu-light',
            before: function (e) {

                e.preventDefault();

                if (contextValue != "") {

                    lastFocusedInput = e.target;

                    return true;
                }
                else {
                    return false;
                }



            }
        });

        $('#ispuser-table_wrapper tr').contextmenu({
            target: '#context-menu',
            before: function (e) {

                e.preventDefault();
                var isPopup = "";
                var target = $(e.target);
                isPopup = $(target).hasClass('popovers')

                var tgname = e.target.tagName;

                if (tgname != "TD") {
                    target = $(e.target).parents('td');
                }
                if (tgname == "TD") {
                    isPopup = $(e.target).find('span').hasClass('popovers')
                }

                var targetText = (target[0].textContent) ;
                if (isPopup) {
                    targetText = $(target[0]).find('span').first().attr('data-content');
                }

                var th = $('#logTable th').eq(target.index()).attr('data-headname');
                contextColumn = th;
                contextValue = targetText;
                return true;

            }
        });


    }

    //Visble column list



    //CSV export callback ajax
    function getCSVAjax(selectedFilterArr, filtersStr, paging, _pageNumber) {




        columns = ["#"];
        columns.push("date"); //date alanı default olarak eklenyior.









        $.ajax({
            async: true,
            type: 'GET',
            url: '/ISP/usereSearch',
            data: {_logfields:selectedFilterArr , _filters: filtersStr  , _paging: paging , _pagenumber: _pageNumber},
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            success: function (data) {


                columns = ["#"];


                var tdata=data;
                var headerCounter = 1;

                selectedFilterArr.forEach(function (val) {

                    //field prop (isselect)
                    var isSelect = "False";


                    headerCounter++;

                    columns.push(val);


                });

                //row
                var tbodyHtml;
                var rowChild = [];
                for (var i = 0; i < tdata[0].headVal.length; i++) {
                    lastrowNumber++;
                    rowChild.push(lastrowNumber);
                    $.each(selectedFilterArr, function (key, value) {


                        var currVal = tdata[key].headVal[i];
                        //render srcname


                        rowChild.push(currVal);


                    });
                    rows.push(rowChild);
                    rowChild = [];
                }

                Logs.callBackCsvExport(selectedFilterArr, filtersStr, paging, _pageNumber);


            },
            error: function (error) {

            },
        });




    }

    //log table empty data
    function emptyData() {







        var emptydata = [{ headName: ["id","username"], headVal: [] }];
        var tdata = emptydata;
        userTable.DataTable().destroy();
        var _t = userTable.children();
        var _head = userTable.children('thead');
        var _tdata = userTable.children('tbody');
        $('#ispuser-table_wrapper').hide();
        _head.children().remove();
        _tdata.children().remove();

        var headtHtml = '<tr>'
        var headerCounter = 1;

        //head html
        var headtHtml = '<tr>'
        var headerCounter = 1;
   //     selectedFilterArr=["id" ,"username","Password","groupname" ,"created_at"]

        selectedFilterArr.forEach(function (val) {

            //field prop (isselect)
            var isSelect = "true";


            headerCounter++;
            headtHtml += '<th id=' + val + ' data-isselect="' + "false" + '" data-id=' + headerCounter + ' data-headname=' + val + ' style="max-width:60px !important" data-exampletext="' + val + '"><span style="padding-left:8px;">' + val + '</span></th>'

        });

        headtHtml += '<th  ' + ' data-isselect="' + "true" + '" data-id=' + headerCounter+ ' style="max-width:60px !important"  ><span style="padding-left:8px;">' + "Action" + '</span></th>'

        headtHtml += '</tr>'

        var tbodyHtml;
        for (var i = 0; i < tdata[0].headVal.length; i++) {

            tbodyHtml += '<tr>'

            $.each(selectedFilterArr, function (key, value) {

                tbodyHtml += '<td>' + tdata[key].headVal[i] + '</td>'

            })

            tbodyHtml += '</tr>'

        }

        _head.append(headtHtml);
        _tdata.append(tbodyHtml);
        Users.dataTableInit();
        Metronic.unblockUI(usersTable);
        $('#ispuser-table_wrapper').show();
        searchBtn.removeAttr('disabled', 'disabled');
        $('.timer').text(0 + " " + l.sec);
        contextMenu();
        $('.popover').remove();

        if (!daterangeSearch) {

            $('.rowcount').text('0 ' + 'Rows');
        }
        else {
            $('.rowcount').hide();
        }


    }

    //date-range search get current search collection
    function getCurrentSearchingCollection(selectedFilterArr, filtersStr) {



            getsetLogData();





    }

    var handlePagelenghtSelect = function () {

        pageLenghtSelect.on('change', function (e) {
            pageLenght = e.val;

            localStorage.setItem("logpageLenght",pageLenght)

            searchBtn.trigger("click");
        })

    }



    var searchHandler = function ( ) {

        var filtersStr = getFilterVal();
        var pageNumber = selectedPage;
        var device = $('#deviceselect').val();
        if (lastFilterObject != '') {
            if (lastFilterObject != filtersStr) {
                pageNumber = 1;
                selectedPage = 1;
                firstDateRangeSearch = true;
            }
        }
        lastFilterObject = filtersStr;

        var paging = pageLenght;


        if (daterangeSearch) {
            getDateRangeResult(selectedFilterArr);
        }
        else {

            $.ajax({
                async: true,
                type: 'GET',
                url: '/ISP/usereSearch',
                data: {_logfields:selectedFilterArr , _filters: filtersStr ,device:device  , _paging: paging , _pagenumber: pageNumber },
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                success: function (data) {
//alert('success')

                    var tdata = data ;
                    userTable.DataTable().destroy();

                    var _t = userTable.children();
                    var _head = userTable.children('thead');
                    var _tdata = userTable.children('tbody');

                    $('#ispuser-table_wrapper').hide();
                    _head.children().remove();
                    _tdata.children().remove();


                    //head html
                    var headtHtml = '<tr>'
                    var headerCounter = 1;
                  //  selectedFilterArr=["id","username","Password","groupname","created_at"]
                    selectedFilterArr.forEach(function (val) {

                        //field prop (isselect)
                        var isSelect = "true";
                        headerCounter++;
                      if(unfilterarray.includes(val))
                      {
                          headtHtml += '<th id='+ val +' data-isselect="' + "true" + '" data-id=' + headerCounter + '"><span style="padding-left:8px;">' + val + '</span></th>'
                      }
                      else  {
                            headtHtml += '<th id=' + val + ' data-isselect="' + "true" + '" data-id=' + headerCounter +
                                ' data-headname=' + val + ' style="max-width:60px !important" data-exampletext="' + val +
                                '"><span style="padding-left:8px;">' + val + '</span></th>'
                         }


                    });
                    headerCounter=headerCounter+1;
                    headtHtml += '<th  ' + ' data-isselect="' + "true" + '" data-id=' + headerCounter+ ' style="max-width:60px !important"  ><span style="padding-left:8px;">' + "Action" + '</span></th>'

                    headtHtml += '</tr>'

                    var tbodyHtml;var ustatus;
                    for (var i = 0; i < tdata[0].headVal.length; i++) {

                        tbodyHtml += '<tr>'
                        var dat='';
                        $.each(selectedFilterArr, function (key, value) {
                             dat+="data-"+value +"='"+tdata[key].headVal[i]+"'" ;
                            tbodyHtml += '<td>' + tdata[key].headVal[i] + '</td>'

                        })



                        tbodyHtml += '<td style="vertical-align:middle;"><a href="javascript:;" class="btn  btn-sm  btn-danger waves-effect waves-float waves-light  deletecapuser"  '+  dat+' >Delete  <i class="fa fa-trash"></i></a><a href="/ISP/users/edit/' + tdata[1].headVal[i]  + '"  class="btn btn-sm btn-success waves-effect waves-float waves-light editcapuser" data-username="' + tdata[1].headVal[i]  + '" data-id="' + tdata[0].headVal[i]  +    '" data-realname="' + tdata[0].headVal[i]  + '" > Edit<i class="fa fa-edit"></i></a> </td>'

                        tbodyHtml += '</tr>'
                        tbodyHtml += '</tr>'

                    }



                    _head.append(headtHtml);
                    _tdata.append(tbodyHtml);

                    Users.dataTableInit();
                    Metronic.unblockUI(usersTable);
                    $('#ispuser-table_wrapper').show();

                    searchBtn.removeAttr('disabled', 'disabled');

                    // $('.timer').text("(" + data.TimeElapsed + " " + 'Seconds' + ")");
                    contextMenu();
                    $('.popover').remove();

                },
                error: function (data) {


                    emptyData();

                }
            })
            if (pageNumber == 1) {
                //getPageCount( ); //pagecount çeker.
            }

        }

    }

    var handleCreateCaptivePortalUser = function () {

        var capguestgrouperror = $('#cap-guest-group-error');
        var capusernameerror = $('#cap-username-error');
        var cappassworderror = $('#cap-password-error');
        var capdatepickererror = $('#cap-datepicker-error');
        var captcerror = $('#cap-tc-error');
        var caprealnameerror = $('#cap-realname-error');
        //init datetime picker



        function SaveEditUser(_id,tc,realname,usergroup, username, password,  callback) {




            var params = {
                "_id":_id, "groupname": usergroup, "username": username, "password": password,  "realname":realname
            };

            $.ajax({
                async: true,
                type: 'GET',
                url: '/Users/EditHotspotUser',
                data: $.param(params),
                dataType: "json",
                success: function (data) {



                    callback(data);
                },
                error: function (data) {
                    $('.refresh-btn').trigger('click');
                    callback(data);
                }
            });

        };

        function AddNewUser(realname,usergroup, username, password, callback) {
            var device = $('#deviceselect').val();
            var params = {
                "groupname": usergroup, "username": username, "password": password,   "realname":realname,"deviceId":device
            };

            $.ajax({
                async: true,
                type: 'GET',
                url: '/Users/AddNewUsers',
                data: $.param(params),
                dataType: "json",
                success: function (data) {
                    setTimeout(function () {




                        setTimeout(function () {
                            $('#searchBtn').trigger('click');
                        }, 1350);


                    }, 300);
                    $('#searchBtn').trigger('click');
                    callback(data);
                },
                error: function (data) {
                    $('#searchBtn').trigger('click');
                    callback(data);
                }
            });

        };

        function AddNewbulk( amount,usergroup, callback) {
            var length=$('#length').val();
            var prefix=$('#prefix').val();
            var device = $('#deviceselect').val();
            var params = {
                "groupname": usergroup, "amount": amount,"prefix":prefix,"length":length,"deviceId":device
            };

            $.ajax({
                async: true,
                type: 'GET',
                url: '/Users/AddNewBulk',
                data: $.param(params),
                dataType: "json",
                success: function (data) {
                    setTimeout(function () {




                        setTimeout(function () {
                            handleOnlineOfflineUsersData(true);
                        }, 1350);


                    }, 300);
                    $('.refresh-btn').trigger('click');
                    callback(data);
                },
                error: function (data) {
                    $('.refresh-btn').trigger('click');
                    callback(data);
                }
            });

        };

        function clearErrorInput() {

            capguestgrouperror.parents('.form-group').removeClass('has-error');
            capguestgrouperror.hide();
            capusernameerror.parents('.form-group').removeClass('has-error');
            capusernameerror.hide();
            cappassworderror.parents('.form-group').removeClass('has-error');
            cappassworderror.hide();
            capdatepickererror.parents('.form-group').removeClass('has-error');
            capdatepickererror.hide();
            captcerror.parents('.form-group').removeClass('has-error');
            captcerror.hide();
            caprealnameerror.parents('.form-group').removeClass('has-error');
            caprealnameerror.hide();

        };


        Ladda.bind('#create-cap-user', {
            callback: function   (instance) {
                savestatus = undefined;
                var progress = 0;
                var interval = setInterval(function () {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);
                }, 200);

                var usergroup = capusergroup.val();
                var username = capusername.val();
                var password = cappassword.val();
                var expiredate = capexpiredate.val();
                var tc = captc.val();
                var realname = caprealname.val();
                var save = true;

                if (usergroup == "") {
                    capguestgrouperror.parents('.form-group').addClass('has-error');
                    capguestgrouperror.show();
                    save = false;
                }
                if (username == "") {
                    capusernameerror.parents('.form-group').addClass('has-error');
                    capusernameerror.show();
                    save = false;
                }
                if (password == "") {
                    cappassworderror.parents('.form-group').addClass('has-error');
                    cappassworderror.show();
                    save = false;
                }


                if (realname == "") {
                    caprealnameerror.parents('.form-group').addClass('has-error');
                    caprealnameerror.show();
                    save = false;
                }


                if (save) {

                    clearErrorInput();

                    AddNewUser(realname,usergroup, username, password,function (data) {

                        if (data != "") {
                            if (data.IsSuccessful=='true') {

                                clearErrorInput();
                                capusername.val('');
                                cappassword.val('');
                                toastr["success"](username + " " + 'Saved Success');

                            }
                            else {
                                toastr["error"]('User Not Created successfully' + data.Description);
                            }
                        }
                        else {
                            toastr["error"]('Undefined Error !');
                        }


                        setTimeout(function () {
                            instance.stop();
                            clearInterval(interval);
                        }, 300);

                    });
                }
                else {
                    setTimeout(function () {
                        instance.stop();
                        clearInterval(interval);
                    }, 300);
                }

            }
        });

        Ladda.bind('#create-bulk_button', {
            callback: function   (instance) {
                savestatus = undefined;
                var progress = 0;
                var interval = setInterval(function () {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);
                }, 200);

                var usergroup = capusergroup.val();
                var amount = $('#amount').val();
                var prefix = $('#prefix').val();
                var length = $('#length').val();

                var save = true;

                if (usergroup == "") {
                    capguestgrouperror.parents('.form-group').addClass('has-error');
                    capguestgrouperror.show();
                    save = false;
                }
                if (amount == "") {
                    capusernameerror.parents('.form-group').addClass('has-error');
                    $('#cap-amount-error').show();
                    save = false;
                }
                if (amount == "") {
                    capusernameerror.parents('.form-group').addClass('has-error');
                    $('#cap-amount-error').show();
                    save = false;
                }
                if (length == "") {
                    capusernameerror.parents('.form-group').addClass('has-error');
                    $('#cap-length-error').show();
                    save = false;
                }
                if (prefix == "") {
                    capusernameerror.parents('.form-group').addClass('has-error');
                    $('#cap-prefix-error').show();
                    save = false;
                }


                if (save) {

                    clearErrorInput();

                    AddNewbulk(amount,usergroup ,function (data) {

                        if (data != "") {
                            if (data.IsSuccessful=='true') {

                                clearErrorInput();
                                capusername.val('');
                                cappassword.val('');
                                toastr["success"](  'Saved Success');

                            }
                            else {
                                toastr["error"]('User Not Created successfully' + data.Description);
                            }
                        }
                        else {
                            toastr["error"]('Undefined Error !');
                        }


                        setTimeout(function () {
                            instance.stop();
                            clearInterval(interval);
                        }, 300);

                    });
                }
                else {
                    setTimeout(function () {
                        instance.stop();
                        clearInterval(interval);
                    }, 300);
                }

            }
        });

        Ladda.bind('#edit-cap-user', {
            callback: function   (instance) {
                savestatus = undefined;
                var progress = 0;
                var interval = setInterval(function () {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);
                }, 200);
                var _id=$('#cap-id').val();

                var usergroup = capusergroup.val();
                var username = capusername.val();
                var password = cappassword.val();
                var expiredate = capexpiredate.val();
                var tc = captc.val();
                var realname = caprealname.val();
                var save = true;

                if (usergroup == "") {
                    capguestgrouperror.parents('.form-group').addClass('has-error');
                    capguestgrouperror.show();
                    save = false;
                }
                if (username == "") {
                    capusernameerror.parents('.form-group').addClass('has-error');
                    capusernameerror.show();
                    save = false;
                }
                if (password == "") {
                    cappassworderror.parents('.form-group').addClass('has-error');
                    cappassworderror.show();
                    save = false;
                }


                if (realname == "") {
                    caprealnameerror.parents('.form-group').addClass('has-error');
                    caprealnameerror.show();
                    save = false;
                }


                if (save) {

                    clearErrorInput();

                    SaveEditUser(_id,tc,realname,usergroup, username, password,  function (data) {

                        if (data != "") {
                            if (data.IsSuccessful=='true') {
                                setTimeout(function () {




                                    setTimeout(function () {
                                        handleOnlineOfflineUsersData(true);
                                    }, 1350);


                                }, 300);
                                clearErrorInput();

                                toastr["success"](username + " " + 'Saved Success');

                            }
                            else {
                                toastr["error"]('User Not Created successfully' + data.Description);
                            }
                        }
                        else {
                            toastr["error"]('Undefined Error !');
                        }


                        setTimeout(function () {
                            instance.stop();
                            clearInterval(interval);
                        }, 300);

                    });
                }
                else {
                    setTimeout(function () {
                        instance.stop();
                        clearInterval(interval);
                    }, 300);
                }

            }
        });


        $('#cap-close').click(function () {
            clearErrorInput();

            $('#cap-password').attr("type", "password");

            $('.refresh-btn').trigger('click');

        });

        $('.viewpass').click(function () {
            $('#cap-password').attr("type", "text");
        });


    };



    var handleEditCaptivePortalUser = function () {

        $('body').on('click', '.editcapuser', function () {
            var _id	= $(this).data('id');
            var groupname = $(this).data('groupname');
            var username = $(this).data('username');
            var password = $(this).data('password');
            var expiredate = $(this).data('expiredate');
            var tc= $(this).data('tc');
            var  realname = $(this).data('realname');
            var expireminute = $(this).data('expireminute');
            var expiresadddatetime = $(this).data('sadddatetime');


            profileSelect.val(groupname).trigger("change");
            capusername.val(username);
            cappassword.val(password);
            capusername.attr("disabled", "disabled");

            $('#cap-datepicker').val(expiredate);
            $('#cap-TC').val(tc);
            $('#cap-id')	.val(_id);
            $('#cap-realname').val(realname);
            $('#edit-cap-user').show();
            $('#username_div').show();
            $('#password_div').show();
            $('#real_div').show();
            $('#amount_div').hide();
            $('#prefix_div').hide();
            $('#length_div').hide();
            $('#create-bulk_button').hide();
            $('#create-cap-user').hide();
            $('#create_captive_portal_user').modal();

        });





        $('body').on('click', '#create_new_user_modal', function () {
            capusername.val("");
            cappassword.val("");
            $('#cap-datepicker').val("");
            $('#cap-TC').val("");
            $('#cap-id')	.val("");
            $('#cap-realname').val("");
            $('#edit-cap-user').hide();
            $('#username_div').show();
            $('#password_div').show();
            $('#real_div').show();
            $('#amount_div').hide();
            $('#prefix_div').hide();
            $('#length_div').hide();
            capusername.removeAttr("disabled");
            $('#create-cap-user').show();
            $('#create-bulk_button').hide();
            $('#create_captive_portal_user').modal();

        });

        $('body').on('click', '#create_bulk_modal', function () {
            $('#username_div').hide();
            $('#password_div').hide();
            $('#real_div').hide();
            $('#amount_div').show();
            $('#prefix_div').show();
            $('#length_div').show();
            $('#create-bulk_button').show();
            $('#create-cap-user').hide();
            $('#create_captive_portal_user').modal();

        });


        $('body').on('click', '.deletecapuser', function () {


            var username = $(this).data('username');
            var deviceid = $(this).data('deviceid');
            capupdatedateval = "";
            var dialog = bootbox.dialog({
                title: '',
                message: "<strong>Are you sure?</strong>",
                buttons: {
                    cancel: {
                        label:"Cancel",
                        className: 'btn-default',
                        callback: function () {
                            return true;
                        }
                    },
                    noclose: {
                        label: "Delete",
                        className: 'btn-info',
                        callback: function () {
                            RemoveCapUser(username);
                            return true;
                        }
                    }
                }
            });

            function RemoveCapUser(username) {

                Metronic.blockUI({
                    target: usersTable,
                    animate: false,
                    boxed: true,
                    message: l.Loading
                });

                $.ajax({
                    async: true,
                    type: 'get',
                    url: '/ISP/users/Delete',
                    data:  {username:  username   } ,
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {

                        if (data != "") {
                            if (data.success=='true') {

                                toastr["success"](data.msg);
                                searchHandler( );


                            }
                            else {
                                toastr["error"]("error " + data.msg);
                                Metronic.unblockUI(usersTable);
                            }
                        }
                    },
                    error: function (data) {
                        toastr["error"](l.err_in_saving_user);
                        Metronic.unblockUI(usersTable);
                    }
                })
            };

        });

    };


    var handleAutoSearch = function () {

        var autoRefreshInterval = undefined;

        $('#auto-refresh-btn').click(function () {

            if ($(this).hasClass('auto-active')) {
                $(this).find('i').removeClass('fa-spin');
                $(this).removeClass('auto-active');
                searchBtn.removeClass('disabled')
                clearInterval(autoRefreshInterval);
                $(this).nextAll("select").prop("disabled", false)

            }
            else {
                $(this).addClass('auto-active');
                $(this).find('i').addClass('fa-spin');

                searchBtn.addClass('disabled');
                $(this).nextAll("select").prop("disabled", true)

                autoRefreshInterval = setInterval(function () {
                    if (!autoRefreshRequest) {
                        autoRefreshRequest = true;
                        searchBtn.trigger('click');
                    }
                }, globalInterval.val());
            }


        });

        globalInterval.select2('val', '3000');


    }



    var handleRightClick = function () {

        contextMenu();


        var copyClipBoard = new Clipboard('#context-copy', {

            text: function () {
                return contextValue;

            }

        });

        //direct search val
        contextSearch.click(function () {

            $('#' + contextColumn + '').find('input').val(contextValue.replace(" ",""));

            //re-search
            searchBtn.trigger("click");


        });

        //add filter val
        contextAddfilter.click(function () {

            var valCheck = $("th #" + contextColumn + '').find('input').val();


            $('#' + contextColumn + '').find('input').val(contextValue.replace(" ",""));

            searchBtn.trigger("click");

        });

        //paste filter val
        contextPaste.click(function () {

            $(lastFocusedInput).val(contextValue).focus();

        });

        //paste research val
        contextPasteSearch.click(function () {

            $(lastFocusedInput).val(contextValue);

            //re-search
            searchBtn.trigger("click");

        });

        //add as col
        addAsColumn.click(function () {

            $.each($('#sidebarMultiSelect').next().find('.multiselect-container.dropdown-menu li').find('input'), function (i, v) {
//alert('add ass column ')
                if ($(v).val() == contextValue.replace(":", "")) {
                    $(v).trigger('click');
                }
            });

            $('#context-menu-details').removeClass('open');

        })
    }






    return {

        //main function
        init: function () {
            localStorage.setItem("logpageLenght",pageLenght)

            currentLang = localStorage.getItem('langname') || 'en';
            cStatus = 0;//counterStat.loading;

            $('.page-footer').css('background-color', '#fff');

            ;




            handlePagelenghtSelect();


            setPagingCount(pagingTotalCount);
            Users.dataTableInit();
            searchHandler( );
          // handleDeAuthUser();
        //    handleDisableUser()
          handleRightClick();
      //      handleAutoSearch()
          handleEditCaptivePortalUser()
        //    getPackages()
        //    handleCreateCaptivePortalUser()
        //    handleDeviceSelect()
            logtype = localStorage.getItem('logtype') || 'all';
         //   sidebarType.select2('val', logtype);

            pageLenght = localStorage.getItem('logpageLenght') || 25;
            pageLenghtSelect.select2('val', pageLenght);

            $(document).click(function (e) {//alert('asdas')


                if ($(e.target).attr('id') != 'starthourtime' && $(e.target).attr('id') != 'endhourtime' && $(e.target).attr('data-toggle') != 'popover') {
                    var status = $('.inputtime').attr('aria-describedby');
                    if (status != undefined) {
                        $('.inputtime').trigger("click");
                    }
                }

                if ($(e.target).attr('id') != 'starthouriepoch' && $(e.target).attr('id') != 'endhouriepoch' && $(e.target).attr('data-toggle') != 'popover') {
                    var status = $('.inputiepoch').attr('aria-describedby');
                    if (status != undefined) {
                        $('.inputiepoch').trigger("click");
                    }
                }


            });

            var table = $('#ispuser-table');
            var oTable = $('#ispuser-table').dataTable();

            searchBtn.click(function () {

                if (searchBtn.attr('disabled') != 'disabled') {



                    deleteopenRow(tdDetails);

                  //  selectedFilterArr=["id","username","Password","groupname","created_at"]


                    searchHandler( );

                    autoRefreshRequest = false;

                }

            });



            //run when press enter.
            $(document).keypress(function (e) {
                if (e.which == 13) {
                    var checkdrShow = $($(e.target).next()[0]);
                    if ($(checkdrShow).find('a.dractive').length < 1) {
                        //re-search
                        searchBtn.trigger("click");

                    }
                    else {
                        if (!$(checkdrShow).is(':visible')) {
                            //re-search
                            searchBtn.trigger("click");
                        }
                    }
                }
            });

            /* Formatting function for row expanded details */
            function fnFormatDetails(oTable, nTr) {

                $(nTr).attr("class", "success"); //tr row highlight

                var aData = oTable.fnGetData(nTr);

                var _rid = aData[4];
                var sFilterArr = [];





                var _logfields = sFilterArr;
                var _filter = getFilterVal();



                var _renderSearchFilter = _filter;
                if (daterangeSearch) {
                    _renderSearchFilter = JSON.parse(_filter);
                    _renderSearchFilter.date = aData[2];
                    _renderSearchFilter = JSON.stringify(_renderSearchFilter);
                }

                $.ajax({
                    async: true,
                    type: 'GET',
                    url: '/Users/detailsSearch',
                    data:  { _id: _rid  , _logfields: _logfields  , _filters: _renderSearchFilter },
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
                        data.forEach(function(item){

                        });

                        rdata = data;
                        var twidth = $('#ispuser-table_wrapper').width() - 15;

                        arr = $.map(rdata, function (e) {

                            var inkey, inval;

                            $.each(e, function (key, value) {

                                inkey = key;
                                inval = value;

                            });

                            return { name: inkey, value: inval };

                        });
                        arr = data;
                        var sOut = '<div class="table-scrollable details" style="width:' + twidth + 'px; padding-bottom: 10px; padding-top: 5px; padding-left: 5px; padding-right: 5px; margin-left: 2px !important;"><table>';


                        for (var i = 0, l = arr.length; i < l; i++) {
                            var items = arr[i];
                            var keys = Object.keys(items);
                            for (var j = 0, k = keys.length; j < k; j+=5) {



                                sOut += '<tr>';

                                try {
                                    sOut += '<td class="dt-subcntxtmenu"><i class="fa fa-arrow-circle-o-right font-green-jungle" style="margin-right:8px;"></i><strong>' + keys[j]  + ':</strong></td>';
                                } catch (e) {

                                }
                                try {

                                    sOut += '<td><span style="margin-right:20px;">' + items[keys[j]] + '</span></td>';
                                } catch (e) { }
                                try {
                                    sOut += '<td class="dt-subcntxtmenu"><i class="fa fa-arrow-circle-o-right font-green-jungle" style="margin-right:8px;"></i><strong>' + keys[j+1]  + ':</strong></td>';
                                } catch (e) { }
                                try {
                                    sOut += '<td><span style="margin-right:20px;">' + items[keys[j+1]]  + '</span></td>';
                                } catch (e) { }
                                try {
                                    sOut += '<td class="dt-subcntxtmenu"><i class="fa fa-arrow-circle-o-right font-green-jungle" style="margin-right:8px;"></i><strong>' + keys[j+2]  + ':</strong></td>';
                                } catch (e) {

                                }
                                try {
                                    sOut += '<td><span style="margin-right:20px;">' + items[keys[j+2]]  + '</span></td>';
                                } catch (e) {

                                }



                                sOut += '</tr>';




                            }
                        }




                        sOut += '</table></div>';

                        oTable.fnOpen(nTr, sOut, 'details');
                        $("body").css("cursor", "default");

                        //details context menu
                        $('#ispuser-table_wrapper table .table-scrollable.details td.dt-subcntxtmenu').contextmenu({
                            target: '#context-menu-details',
                            before: function (e) {

                                e.preventDefault();
                                var isPopup = "";
                                var target = $(e.target);
                                isPopup = $(target).hasClass('popovers')

                                var tgname = e.target.tagName;

                                if (tgname != "TD") {
                                    target = $(e.target).parents('td');
                                }


                                if (tgname == "TD") {
                                    isPopup = $(e.target).find('span').hasClass('popovers')
                                }

                                var targetText = (target[0].textContent).clearParam();
                                if (isPopup) {
                                    targetText = $(target[0]).find('span').first().attr('data-content');
                                }


                                var th = $('#logTable th').eq(target.index()).attr('data-headname');

                                contextColumn = th;

                                contextValue = targetText;

                                return true;

                            }
                        });

                    },
                    error: function (error) { $("body").css("cursor", "default"); }
                });


            }

            table.on('click', 'tbody td .row-details', function () {

                tdDetails.push($(this));

                var nTr = $(this).parents('tr')[0];
                if (oTable.fnIsOpen(nTr)) {
                    /* This row is already open - close it */
                    $(this).addClass("row-details-close").removeClass("row-details-open");
                    $(nTr).attr("class", "");
                    oTable.fnClose(nTr);
                } else {
                    /* Open this row */
                    $(this).addClass("row-details-open").removeClass("row-details-close");
                    $("body").css("cursor", "progress");
                    fnFormatDetails(oTable, nTr);
                }


            });




            getPageCount( );

            $('#pageCounter').bootpag().on("page", function (event, num) {
                selectedPage = num;
                //re-search
                searchBtn.trigger("click");
            });





            $('#csvmodalOn').click(function () {

                var interval;

                $('#csvExportModal').modal('show');

                setTimeout(function () {

                    Metronic.blockUI({
                        target: $('#csvExportModal').find('.modal-body'),
                        animate: false,
                        boxed: true,
                        message:"Loading.."
                    });


                    interval = setInterval(function () {

                        if (cStatus == 1) {

                            _pagingTotalCount = pagingTotalCount;
                            if (_pagingTotalCount < 1) {
                                _pagingTotalCount = 1;
                            }
                            if (_pagingTotalCount < 6) {
                                csvEndPAge.val(_pagingTotalCount);
                            }
                            else {
                                csvEndPAge.val(6);
                            }

                            Metronic.unblockUI($('#csvExportModal').find('.modal-body'));
                            clearInterval(interval);
                        }



                    }, 1000);


                }, 300);

            });

            exportCsvBtn.on('click', function () {

                var _startPage = csvStartPage.val();
                var _endPAge = csvEndPAge.val();
                var csvProgress = $('#csvProgress').find('.barratio');
                columns = [];
                rows = [];
                lastrowNumber = 0;

                var paging = pageLenght;
                function searchCSV() {


                    var colData = sidebarColumn.children();


                    for (i = 0; i < colData.length; i++) {
                        var a = $(colData[i]);
                        if (a.attr('data-checked') == 'true') {
                            var _colid = a.attr('data-headname');
                            selectedFilterArr.push(_colid);
                        }
                    }
               //     selectedFilterArr=["id" ,"username","Password","groupname",'phone',"created_at"]

                    if (!daterangeSearch) {
                        searchHandler( );
                    }

                    var filtersStr = getFilterVal();
                    //yeni bir filtreleme işlemi gerçekleştiğinde page number'ı 1 e çeker sıfırlar. ve pagecounter'ı çeker
                    if (lastFilterObject != '') {
                        if (lastFilterObject != filtersStr) {
                            pageNumber = 1;
                            selectedPage = 1;
                        }
                    }
                    lastFilterObject = filtersStr;

                    var _pageNumber = _startPage;

                    getCSVAjax(selectedFilterArr, filtersStr, paging, _pageNumber);

                }
                searchCSV();

            });

            csvStartPage.on('keyup', function () {

                var clearVal = $(this).val().replace(/[^0-9.]/g, '').replace(/,/g, '');
                $(this).val(clearVal);
                var currentStartPage = parseInt($(this).val());
                //check other input end page


                if (isNaN(currentStartPage)) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html("Start   Page  Number not Vaild");
                }
                else if (currentStartPage < 1) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html('Start   Page  Number not Vaild' + "</br>(" + 'Min Number' + ": 1)");
                }

                else if (isNaN(currentEndPage)) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html("End   Page  Number not Vaild");
                }
                else if (currentEndPage > pagingTotalCount) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html("Start   Page  Number not Vaild" + "</br>(" + "MAX Number "+ ": " + (pagingTotalCount).formatNumber(0) + ")");
                }

                else {
                    exportCsvBtn.removeAttr("disabled");
                    $('#csvStatusCode').html(l.ready_for_export);
                }

            });

            csvEndPAge.on('keyup', function () {

                _pagingTotalCount = parseInt(pagingTotalCount);
                if (_pagingTotalCount < 1) {
                    _pagingTotalCount = 1;
                }

                var clearVal = $(this).val().replace(/[^0-9.]/g, '').replace(/,/g, '');
                $(this).val(clearVal);
                var currentEndPage = parseInt($(this).val());
                //check other input start page


                if (isNaN(currentEndPage)) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html(l.end_page_number_error);
                }
                else if (currentEndPage > _pagingTotalCount) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html("End   Page  Number not Vaild" + "</br>(" + "MAX Number" + ": " + (_pagingTotalCount).formatNumber(0) + ")");
                }


                else if (isNaN(currentStartPage)) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html("Start   Page  Number not Vaild");
                }
                else if (currentStartPage < 1) {
                    exportCsvBtn.attr("disabled", "disabled");
                    $('#csvStatusCode').html("Start   Page  Number not Vaild" + "</br>(" + "Min Number" + ": 1)");
                }

                else {
                    exportCsvBtn.removeAttr("disabled");
                    $('#csvStatusCode').html(l.ready_for_export);
                }



            });

            $('#csvCancel').click(function () {
                isCsvCancel = true;
                exportCsvBtn.removeAttr("disabled");
                $('#csvStatusCode').html(l.ready_for_export);
            });
            searchBtn.trigger("click");
        },
        //datatable function

        dataTableInit: function () {


            var table = $('#ispuser-table');

            var nCloneTh = document.createElement('th');
            nCloneTh.className = "table-checkbox";

            var nCloneTd = document.createElement('td');
            nCloneTd.innerHTML = '<span style="min-width: 16px !important;" class="row-details row-details-close"></span>';

            // table.find('thead tr').each(function () {
            //     this.insertBefore(nCloneTh, this.childNodes[0]);
            // });
            //
            // table.find('tbody tr').each(function () {
            //     this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
            // });

            var oTable = table.dataTable({
                "columnDefs": [

                    {
                        "render": function (data, type, row) {
                              if(data=='online')
                            //  alert('render')
                            return  '<span class="badge badge-pill badge-light-success" text-capitalized="">online</span> ';
                            else if(data=='offline')
                                //  alert('render')
                                return  '<span class="badge badge-pill badge-light-default" text-capitalized="">offline</span> ';
                              else if(data=='notActive')
                                  //  alert('render')
                                  return  '<span class="badge badge-pill badge-light-danger" text-capitalized="">Not Active</span> ';

                        },
                        "targets":0// getColumnIndex("password")
                    },
                 ],
                "language": $.fn.dataTable.language,

                "ordering": false,
                "filter": false,
                "paginate": false,
                "destroy": true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Add New User',
                        className: 'table_btn add-new btn btn-primary mt-50',
                        attr: {
                            style:'border-radius:5px',


                        },
                        action: function (e, dt, node, config)
                        {
                            //This will send the page to the location specified
                            window.location.href = '/ISP/users/adduser';
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    },
                    {
                        text: 'Search',
                        className: 'table_btn  btn btn-success waves-effect waves-float waves-light',
                        attr:  {

                            id: 'searchBtn',
                            style:'border-radius:5px'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        },
                        action: function ( e, dt, node, config ) {
                            deleteopenRow(tdDetails);

                            //  selectedFilterArr=["id","username","Password","groupname","created_at"]


                            searchHandler( );
                        }
                    },
                    {
                        text: 'Clear',
                        className: 'table_btn  btn btn-danger mt-50',
                        attr:  {


                            style:'border-radius:5px'
                        },


                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ]

            });

            //handle popovers
            $('.popovers').popover({
                'html': true,
                'container': 'body',
                'trigger': 'hover',
                'placement': 'left'
            });

            var tableWrapper = $('#ispuser-table_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
            var tableColumnToggler = $('#log_column_toggler');

            //toolbar positin change
            $(".PaginationLenContainer").append($(".dataTables_length"));

            $(".dataTables_info").remove();

            //plugin css change
            $('.table-scrollable').attr('style', 'white-space:nowrap;');

            //filtreleme için
            runFilter(oTable);

        },

        callBackCsvExport: function (selectedFilterArr, filtersStr, paging, _pageNumber) {

            var _endPAge = csvEndPAge.val();
            var _startPAge = csvStartPage.val();


            if (isCsvCancel) {
                endCSV();
            }

            if (_startPAge == _endPAge) {
                endCSV();
            }
            else {
                if (!isCsvCancel) {

                    if (_pageNumber < _endPAge) {

                        _pageNumber++;
                        getCSVAjax(selectedFilterArr, filtersStr, paging, _pageNumber);

                        var csvProgress = $('#csvProgress').find('.barratio');
                        var percent = (_pageNumber * 100) / (_endPAge);
                        $(csvProgress).css('width', '' + percent + '%');
                        $(csvProgress).find('.sr-only').text("" + percent.toFixed() + "% " + l.completed);
                        $('#csvStatusCode').html(l.creating_pages + " :" + _pageNumber + "</br>" + l.total_rows + " :" + (_pageNumber - _startPAge + 1) * paging + "");

                        if (_pageNumber == _endPAge) {

                            endCSV();

                        }

                    }
                }
            }

            function endCSV() {

                exportCsvBtn.attr("disabled", "disabled");
                $('#csvStatusCode').append('</br>' + 'Export is Done');

                setTimeout(function () {


                    var exportDate = moment($('#sidebarDate').val(), "YYYY-MM-DD").format("DD-MM-YYYY");

                    var fileName = "Log Data " + exportDate + ".csv";
                    var csvData = "";
                    var headLine = "";
                    var body = "";

                    for (var i = 1; i < columns.length; i++) {
                        headLine += columns[i] + ";"
                    }

                    $.each(rows, function (k, v) {
                        for (var i = 1; i < v.length; i++) {
                            body += v[i] + ";";
                        }
                        body += "\r"
                    });

                    csvData += headLine + "\r";
                    csvData += body;

                    var textFile = null;
                    makeTextFile = function (text) {
                        var data = new Blob([text], { type: 'text/plain' });

                        // If we are replacing a previously generated file we need to
                        // manually revoke the object URL to avoid memory leaks.
                        if (textFile !== null) {
                            window.URL.revokeObjectURL(textFile);
                        }

                        textFile = window.URL.createObjectURL(data);

                        return textFile;
                    };
                    var link = document.getElementById('downloadCsvlink');
                    link.href = makeTextFile(csvData);
                    link.download = fileName;
                    if (link) {
                        link.click();
                    }

                    $('#csvStatusCode').text('Completed');
                    $('#csvExportModal').modal('hide');

                    $('#csvStatusCode').text('Ready for Export');
                    $(csvProgress).css('width', '0%');
                    $(csvProgress).find('.sr-only').text("0% " + 'Completed');
                    csvStartPage.val(1);

                    _pagingTotalCount = pagingTotalCount;
                    if (_pagingTotalCount < 1) {
                        _pagingTotalCount = 1;
                    }
                    if (_pagingTotalCount < 6) {
                        csvEndPAge.val(_pagingTotalCount);
                    }
                    else {
                        csvEndPAge.val(6);
                    }

                    exportCsvBtn.removeAttr("disabled");


                }, 1000);

            }

        }

    };

}();

jQuery(document).ready(function () {

    Users.init();

});
