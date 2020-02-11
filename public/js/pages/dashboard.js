/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999,
    update              :  function(event, ui) {
      var widgetsLeft = $("#sortableLeft .widget-s");
      var widgetsRight = $("#sortableRight .widget-s");
      var leftIds = "";
      var rightIds = "";
      $.each(widgetsLeft, (item, i) => {
        leftIds += $(i).attr("widget-id")+"@#";
      });
      $.each(widgetsRight, (item, i) => {
        rightIds += $(i).attr("widget-id")+"@#";
      });
      $.ajax({
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "MyProfile.updateDashboard",
        data: {
          leftIds: leftIds,
          rightIds: rightIds
        },
        success: function(data)
        {
          if (data != "OK") console.log(data);
        }
      })
    }
  })
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999,
  });

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()


  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

});