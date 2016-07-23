<div class="container" data-ng-controller="StudentsController" style="background-color: #9E9E9E">
    <h2> View Students <%teste%></h2>
    Search:
    <br/>
    <input type="text" ng-model="name" />
    <br/>
    <ul>
        <li ng-repeat="student in students | filter:name"><%student.name%> , <%student.city%></li>
    </ul>

    <a href="#/home"> Back</a>
</div>
