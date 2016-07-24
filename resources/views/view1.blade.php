<div data-ng-controller="StudentsController">
    <h2> View Students <%teste%></h2>
    Search:
    <br/>
    <input type="text" ng-model="name" />
    <br/>
    <ul>
        <li ng-repeat="student in students | filter:name"><%student.name%>, <%student.city%></li>
    </ul>

    <a href="javascript:void(0)" ng-click="menuItem('home')"> Home</a>
</div>
