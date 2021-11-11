import React, {useState, useEffect} from 'react';
import estadosServices from "../../../services/Parameters/Estados";
import MaterialTable from "material-table";


function EjemploTable(props) {
    const [listEstados, setListEstados] = useState([]);
    const [listarEstados, setListarEstados] = useState([]);

    useEffect(() => {
        async function fetchDataEstados() {
          const res = await estadosServices.listEstados();
          setListEstados(res.data);
          //console.log("DATOS ESTADOS ",res.data);
        }
        fetchDataEstados();
      }, [])

      const columnas = [
        {
          title: 'Id',
          field: 'id_est',
          cellStyle: { minWidth: 400 },
          fontSize: 20
        },
        {
          title: 'Descripción',
          field: 'nombre_est',
        },
        {
          title: 'Tipos Estados',
          field: 'descripcion_test'
        },
        {
          title: 'Observación',
          field: 'observacion_est',
          cellStyle: { minWidth: 400 }
        },
        {
          title: 'Codigo Empresa',
          field: 'empresa_est'
        },
        {
          title: 'Nombre Empresa',
          field: 'nombre_emp'
        }
      ]

    return (
        <div>
           <MaterialTable
        columns={columnas}
        data={listEstados}
        title="MAESTRA DE ESTADOS"
        actions={[
          {
            icon: 'edit',
            tooltip: 'Editar Estado',
            onClick: (event, rowData) => seleccionarEstado(rowData, "Editar")
          },
          {
            icon: 'delete',
            tooltip: 'Borrar Estado',
            onClick: (event, rowData) => seleccionarEstado(rowData, "Eliminar")
          }
        ]}
        options={{
          actionsColumnIndex: -1,
          headerStyle:{backgroundColor:'red', fontSize: 20},
          rowStyle: {
            fontSize: 16,
          }
        }}
        localization={{
          header: {
            actions: "Acciones"
          }
        }}
      />{ }
  
        </div>
    );
}

export default EjemploTable;