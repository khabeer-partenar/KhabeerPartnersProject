@extends('layouts.dashboard.index')
<!DOCTYPE html>

<html>

<head>

    <title>{{__('committee::committees.information')}} </title>

    <style type="text/css">

        table{

            width: 100%;

            border:1px solid black;

        }

        td, th{

            border:1px solid black;

        }

    </style>
    {{--<style>
        * { font-family: DejaVu Sans; }
    </style>--}}
</head>

<body>



<h2>{{__('committee::committees.information')}}</h2>

<table>

    <tr>

        <th>No.</th>

        <th>Name</th>

    </tr>

    <tr>

        <td>1</td>

        <td>Vimal Kashiyani</td>

    </tr>

    <tr>

        <td>2</td>

        <td>Hardik Savani</td>

    </tr>

    <tr>

        <td>1</td>

        <td>Harshad Pathak</td>

    </tr>

</table>



</body>

</html>