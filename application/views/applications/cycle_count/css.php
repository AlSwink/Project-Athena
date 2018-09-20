<style>
  .progress-bar-vertical {
    width: 20px;
    min-height: 100px;
    margin-right: 20px;
    float: left;
    display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
    display: -ms-flexbox;  /* TWEENER - IE 10 */
    display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
    display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */
    align-items: flex-end;
    -webkit-align-items: flex-end; /* Safari 7.0+ */
  }

  .progress-bar-vertical .progress-bar {
    width: 100%;
    height: 0;
    -webkit-transition: height 0.6s ease;
    -o-transition: height 0.6s ease;
    transition: height 0.6s ease;
  }

  .nav-tabs .nav-link:not(.active){
    border: 1px solid #e9ecef !important;
    color: #495057;
  }

  .nav-tabs .active{
    color: red !important;
  }

  .smaller{
    font-size: 25px;
    color: #969696;
  }

  .sub-header{
    font-size: 17px;
    color: #969696;
  }

  .bbr-0{
    border-bottom-left-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
  }

  th{
    font-size: 11px !important;
  }

  td{
    font-size: 10px;
  }

</style>