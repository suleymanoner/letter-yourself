class Communication {

  static init(){
    Communication.getComm();
  }

  static getComm(){

      $("#communication-table").DataTable({
      processing : true,
      serverSide : true,
      bDestroy: true,
      searching: false,
      ordering: false,
      pagingType : "simple",
      preDrawCallback : function( settings ) {
        if (settings.aoData.length < settings._iDisplayLength){
          settings._iRecordsTotal=0;
          settings._iRecordsDisplay=0;
        }else{
          settings._iRecordsTotal=100000;
          settings._iRecordsDisplay=100000;
        }
        console.log(settings);
      },
      responsive: true,
      language: {
            "zeroRecords": "Nothing found",
            "info": "Showing page _PAGE_",
            "infoEmpty": "",
            "infoFiltered": ""
      },
      ajax : {
        url: "api/person/communication",
        type: "GET",
        beforeSend: function(xhr){xhr.setRequestHeader('Authentication', localStorage.getItem("token"))},
        dataSrc : function(resp){
          return resp;
        },
        data : function ( d ) {
          d.offset = d.start;
          d.limit = d.length;

          delete d.start;
          delete d.columns;
          delete d.length;
          delete d.draw;
          console.log(d);
        }
      },
      columns : [
          { "data": "letter_title",
            "render": function ( data ) {
              return '<div><span class="badge">'+data+'</div>';
            }
          },
          { "data": "email" }
      ]
    });
  }
  
}
