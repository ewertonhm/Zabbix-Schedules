<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Map\\GrupoScheduleTableMap',
    1 => '\\Map\\GrupoTableMap',
    2 => '\\Map\\HostScheduleTableMap',
    3 => '\\Map\\HostTableMap',
    4 => '\\Map\\LogDeleteGrupoScheduleTableMap',
    5 => '\\Map\\LogDeleteHostScheduleTableMap',
    6 => '\\Map\\LogDeleteMacroScheduleTableMap',
    7 => '\\Map\\LogEditHostScheduleTableMap',
    8 => '\\Map\\LogEditeGrupoScheduleTableMap',
    9 => '\\Map\\LogEditeMacroScheduleTableMap',
    10 => '\\Map\\LogGrupoExecutionTableMap',
    11 => '\\Map\\LogHostExecutionTableMap',
    12 => '\\Map\\LogMacroExecutionTableMap',
    13 => '\\Map\\LogTableMap',
    14 => '\\Map\\MacroScheduleTableMap',
    15 => '\\Map\\MacroTableMap',
    16 => '\\Map\\ScheduleTableMap',
    17 => '\\Map\\UsuarioTableMap',
  ),
));
