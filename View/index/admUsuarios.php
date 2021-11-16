<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}
include_once "../structure/header.php";
if ($session->getRolActivo()["idrol"] != "1") { ?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            ACCESO PROHIBIDO
        </div>
    </div>
    <?php
} else {
    ?>

    <table id="dg" title="Usuarios" class="easyui-datagrid p-3"
           url="../accion/admin/listarUsuario.php"
           toolbar="#toolbar" pagination="true"
           rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="idusuario" width="20">ID</th>
            <th field="usnombre" width="50">Nombre</th>
            <th field="uspass" width="120">Contraseña</th>
            <th field="usmail" width="60">Email</th>
            <th field="usdeshabilitado" width="70">Deshabilitado</th>
        </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo
            Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar
            Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
           onclick="destroyUser()">Eliminar usuario</a>
    </div>

    <div id="dlg" class="easyui-dialog" style="width:400px"
         data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Datos Usuario</h3>
            <div style="margin-bottom:10px">
                <input name="usnombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="uspass" class="easyui-textbox" required="true" label="Contraseña:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="usmail" class="easyui-textbox" required="true" label="E-mail:" style="width:100%">
            </div>
            <div>
                <input name="idusuario" value="idusuario" type="hidden">
            </div>
            <div>
                <input name="usdeshabilitado" value="usdeshabilitado" type="hidden">
            </div>

        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()"
           style="width:90px">OK</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
           onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    </br>

    <table id="dgRol" title="UsuarioRol" class="easyui-datagrid p-3" style="width:700px;height:250px"
           url="../accion/admin/listarUsuarioRol.php"
           toolbar="#toolbar2" pagination="true"
           rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="idusuario" width="50">ID</th>
            <th field="usnombre" width="50">Usuario</th>
            <th field="idrol" width="50">Rol</th>
            <th field="rodescripcion" width="50">Descripcion</th>
        </tr>
        </thead>
    </table>

    <div id="toolbar2">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUsRol()">Nuevo
            Rol Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
           onclick="destroyUsRol()">Eliminar Rol Usuario</a>
    </div>

    <div id="dlgRol" class="easyui-dialog" style="width:400px"
         data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRol-buttons'">
        <form id="fmRol" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion UsuarioRol</h3>
            <div style="margin-bottom:10px">
                <input name="idusuario" class="easyui-textbox" required="true" label="ID Usuario:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="idrol" class="easyui-textbox" required="true" label="ID Rol:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlgRol-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsRol()"
           style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
           onclick="javascript:$('#dlgRol').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    </br>

    <table id="dgRoll" title="Rol" class="easyui-datagrid p-3" style="width:700px;height:250px"
           url="../accion/admin/listarRol.php"
           toolbar="#toolbar3" pagination="true"
           rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="idrol" width="50">ID</th>
            <th field="rodescripcion" width="50">Descripcion</th>
        </tr>
        </thead>
    </table>

    <div id="toolbar3">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRol()">Nuevo
            Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editRol()">Editar
            Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
           onclick="destroyRol()">Eliminar Rol</a>
    </div>

    <div id="dlgRoll" class="easyui-dialog" style="width:400px"
         data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRoll-buttons'">
        <form id="fmRoll" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Datos Rol</h3>
            <div style="margin-bottom:10px">
                <input name="rodescripcion" class="easyui-textbox" required="true" label="Descripcion:"
                       style="width:100%">
            </div>
            <div>
                <input name="idrol" value="idrol" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlgRoll-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveRol()"
           style="width:90px">OK</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
           onclick="javascript:$('#dlgRoll').dialog('close')" style="width:90px">Cancelar</a>
    </div>


    <script type="text/javascript">
        var url;

        function newUser() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Usuario');
            $('#fm').form('clear');
            url = '../accion/admin/createUsuario.php';
        }

        function editUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Usuario');
                $('#fm').form('load', row);
                url = '../accion/admin/updateUsuario.php';
            }
        }

        function saveUser() {
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
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }

        function destroyUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Desea cambiar el estado del Usuario?', function (r) {
                    if (r) {
                        $('#fm').form('load', row);
                        url = 'accion/admin/deleteUsuario.php';
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
                                    $('#dg').datagrid('reload');    // reload the menu data
                                }
                            }
                        });
                    }
                });
            }
        }

        // UsuarioRol

        function newUsRol() {
            $('#dlgRol').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Usuario');
            $('#fmRol').form('clear');
            url = '../accion/admin/createUsuarioRol.php';
        }

        function saveUsRol() {
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
                        $('#dlgRol').dialog('close');        // close the dialog
                        $('#dgRol').datagrid('reload');    // reload the user data
                    }
                }
            });
        }

        function destroyUsRol() {
            var row = $('#dgRol').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Está seguro que quiere eliminar la selección?', function (r) {
                    if (r) {
                        $.post('../accion/admin/deleteUsuarioRol.php', {
                            idusuario: row.idusuario,
                            idrol: row.idrol
                        }, function (result) {
                            if (result.respuesta) {
                                $('#dgRol').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        }, 'json');
                    }
                });
            }
        }

        // Rol

        function newRol() {
            $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Rol');
            $('#fmRoll').form('clear');
            url = '../accion/admin/createRol.php';
        }

        function editRol() {
            var row = $('#dgRoll').datagrid('getSelected');
            if (row) {
                $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle', 'Editar Rol');
                $('#fmRoll').form('load', row);
                url = '../accion/admin/updateRol.php?id=' + row.id;
            }
        }

        function saveRol() {
            $('#fmRoll').form('submit', {
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
                        $('#dlgRoll').dialog('close');        // close the dialog
                        $('#dgRoll').datagrid('reload');    // reload the user data
                    }
                }
            });
        }

        function destroyRol() {
            var row = $('#dgRoll').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Desea eliminar la selección?', function (r) {
                    if (r) {
                        $.post('../accion/admin/deleteRol.php', {idrol: row.idrol}, function (result) {
                            console.log(result);
                            if (result.respuesta) {
                                $('#dgRoll').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
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