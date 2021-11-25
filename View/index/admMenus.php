<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}
include_once "../structure/header.php";
if ($session->getRolActivo() != "1") { ?>
    <div class="container">
        <div class="alert alert-danger p-3" role="alert">
            ACCESO PROHIBIDO
        </div>
    </div>
    <?php
} else {

    include_once("../structure/menuLateral.php");

    ?>
    <div class="col-9 p-2 mt-2 mb-2">
        <h2 class="text-center">Administración menu</h2>
        <table id="dg" title="Menu" class="easyui-datagrid"
               url="../action/admin/Menu/listarMenu.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="idmenu" width="20">ID</th>
                <th field="menombre" width="90">Nombre</th>
                <th field="medescripcion" width="70">Descripcion</th>
                <th field="idpadre" width="30">ID padre</th>
                <th field="medeshabilitado" width="70">Deshabilitado</th>
            </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMenu()">Nuevo
                Menu</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true"
               onclick="editMenu()">Editar
                Menu</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
               onclick="destroyMenu()">Baja/Alta</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px"
             data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion Menu</h3>
                <div style="margin-bottom:10px">
                    <input name="menombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="medescripcion" class="easyui-textbox" required="true" label="Descripcion:"
                           style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="idpadre" class="easyui-textbox" label="ID Padre:" style="width:100%">
                </div>
                <div>
                    <input name="medeshabilitado" value="medeshabilitado" type="hidden">
                </div>
                <div>
                    <input name="idmenu" value="idmenu" type="hidden">
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMenu()"
               style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
               onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>

        </br>

        <table id="dgRol" title="MenuRol" class="easyui-datagrid"
               url="../action/admin/Menu/listarMenuRol.php"
               toolbar="#toolbar2" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="idmenu" width="50">ID</th>
                <th field="menombre" width="50">Menu</th>
                <th field="idrol" width="50">Rol</th>
                <th field="roldescripcion" width="50">Descripcion</th>
            </tr>
            </thead>
        </table>

        <div id="toolbar2">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMeRol()">Nuevo
                Rol Menu</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
               onclick="destroyMeRol()">Eliminar Rol Menu</a>
        </div>

        <div id="dlgRol" class="easyui-dialog" style="width:400px"
             data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRol-buttons'">
            <form id="fmRol" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion MenuRol</h3>
                <div style="margin-bottom:10px">
                    <input name="idmenu" class="easyui-textbox" required="true" label="ID Menu:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="idrol" class="easyui-textbox" required="true" label="ID Rol:" style="width:100%">
                </div>
            </form>
        </div>
        <div id="dlgRol-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMeRol()"
               style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
               onclick="javascript:$('#dlgRol').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    <script type="text/javascript">
        var url;

        function newMenu() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Menu');
            $('#fm').form('clear');
            url = '../action/admin/Menu/createMenu.php';
        }

        function editMenu() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Menu');
                $('#fm').form('load', row);
                url = '../action/admin/Menu/updateMenu.php';
            }
        }

        function saveMenu() {
            $('#fm').form('submit', {
                url: url,
                iframe: false,
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                }
            });
        }

        function destroyMenu() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', 'Cambiar el estado del menu?', function (r) {
                    if (r) {
                        $('#fm').form('load', row);
                        url = '../action/admin/Menu/deleteMenu.php';
                        $('#fm').form('submit', {
                            url: url,
                            iframe: false,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (result) {
                                var result = eval('(' + result + ')');
                                if (result.errorMsg) {
                                    $.messager.show({
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                } else {
                                    $('#dg').datagrid('reload');
                                }
                            }
                        });
                    }
                });
            }
        }

        // MenuRol

        function newMeRol() {
            $('#dlgRol').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Menu');
            $('#fmRol').form('clear');
            url = '../action/admin/Menu/createMenuRol.php';
        }

        function saveMeRol() {
            $('#fmRol').form('submit', {
                url: url,
                iframe: false,
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlgRol').dialog('close');
                        $('#dgRol').datagrid('reload');
                    }
                }
            });
        }

        function destroyMeRol() {
            var row = $('#dgRol').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', 'Esta seguro que desea eliminar este Menu-Rol?', function (r) {
                    if (r) {
                        $.post('../action/admin/Menu/deleteMenuRol.php', {
                            idmenu: row.idmenu,
                            idrol: row.idrol
                        }, function (result) {
                            if (result.respuesta) {
                                $('#dgRol').datagrid('reload');
                            } else {
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        }, 'json');
                    }
                });
            }
        }
    </script>
    <?php
}
?>

<?php
include_once "../structure/footer.php";
?>