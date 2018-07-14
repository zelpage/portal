var container = $("#carousel");
    
    var runner = container.find('ul');
    var liWidth = runner.find('li:first').outerWidth();
    var itemsPerPage = 3;
    var noofitems = runner.find('li').length;
    
    runner.width(noofitems * liWidth);
    container.width(itemsPerPage*liWidth);

    $('#right').click(function() {
        $(runner).animate({ "left": "-=51px" }, "slow" );
    });
    
    
    $('#left').click(function() {
        $(runner).animate({ "left": "+=51px" }, "slow" );
    });

