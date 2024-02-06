<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>{{theSiteName()}} Admin</title>
<!-- Bootstrap core CSS-->
<link href="{{ URL::asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Custom fonts for this template-->
<link href="{{ URL::asset('admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<!-- Page level plugin CSS-->
<link href="{{ URL::asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="{{ URL::asset('admin/css/sb-admin.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script type="text/javascript">
var ajaxURL1='';
var orderCol=[];
</script>
@yield('stylesheet')
</head>