<Core.Db.Detail table="tests" itemId="0" layout="admin/grid/test/detail">
    <Core.Db.List id="gridtestChildren" parentMode="true"
                  parentField="testId" parentId="0" parentWhere = 'like'
                  layout="admin/grid/test/listChild"
                  table="questions" />
</Core.Db.Detail>