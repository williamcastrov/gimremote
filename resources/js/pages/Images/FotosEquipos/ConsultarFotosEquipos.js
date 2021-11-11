import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import { Modal, TextField, Button, Typography } from "@material-ui/core";
import { makeStyles } from "@material-ui/core/styles";
import FileCopyIcon from '@material-ui/icons/FileCopy';
import swal from 'sweetalert';

import fotosequiposServices from "../../../services/Mantenimiento/FotosEquipos";

const useStyles = makeStyles((theme) => ({
  modal: {
    position: 'absolute',
    width: 1400,
    backgroundColor: theme.palette.background.paper,
    border: '2px solid #000',
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2, 4, 3),
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)'
  },
  modal2: {
    position: 'absolute',
    width: 600,
    backgroundColor: theme.palette.background.paper,
    border: '2px solid #000',
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2, 4, 3),
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)'
  },
  iconos: {
    cursor: 'pointer'
  },
  inputMaterial: {
    width: '100%'
  },
  typography: {
    fontSize: 16,
    color: "#ff3d00"
  }
}));

function ConsultarFotosEquipos(props) {
  const { codigoequipo } = props;
  //console.log("CODIGO EQUIPO : ", codigoequipo)
  const styles = useStyles();
  const [listConsultarFotosEquipos, setListConsultarFotosEquipos] = useState([]);
  const [validar, setValidar] = useState([]);
  const [modalInsertar, setModalInsertar] = useState(false);
  const [modalEditar, setModalEditar] = useState(false);
  const [modalEliminar, setModalEliminar] = useState(false);
  const [actualiza, setActualiza] = useState(false);
  const [fotoEquipoSeleccionado, setFotoEquipoSeleccionado] = useState({
    id: "",
    type: "",
    name: "",
    nombrefoto: "",
    fechafoto: "",
    url: "",
    codigoequipo: ""
  })

  const handleChange = e => {
    const { name, value } = e.target;

    setFotoEquipoSeleccionado(prevState => ({
      ...prevState,
      [name]: value
    }));
  }

  const seleccionarFotoEquipo = (foto, caso) => {
    setFotoEquipoSeleccionado(foto);
    (caso === "Eliminar") ? abrirCerrarModalEliminar() : abrirCerrarModalEliminar()
  }

  const mostrarFotoEquipo = (foto, caso) => {
    console.log("VALOR FOTO : ", foto)
    if (foto) {
      mostrarFoto(foto.name)
    }
  }

  const abrirCerrarModalInsertar = () => {
    setModalInsertar(!modalInsertar);
  }

  const abrirCerrarModalEditar = () => {
    //setModalEditar(!modalEditar);
  }

  const abrirCerrarModalEliminar = () => {
    setModalEliminar(!modalEliminar);
  }

  useEffect(() => {
    async function fetchDataFotoEquipo() {
      const res = await fotosequiposServices.listfotosequipos(codigoequipo);
      setListConsultarFotosEquipos(res.data);
      setValidar(res.data);
      setActualiza(false);
    }
    fetchDataFotoEquipo();
  }, [actualiza])


  const borrarFotoEquipo = async () => {

    const res = await fotosequiposServices.delete(fotoEquipoSeleccionado.id);

    if (res.success) {
      swal({
        title: "Consultar Fotos Equipos",
        text: "Foto del Equipo Borrada de forma Correcta!",
        icon: "success",
        button: "Aceptar"
      });
      console.log(res.message)
      abrirCerrarModalEliminar();
    }
    else {
      swal({
        title: "Consultar Fotos Equipos",
        text: "Error Borrando la Foto del Equipo!",
        icon: "error",
        button: "Aceptar"
      });
      console.log(res.message);
      abrirCerrarModalEliminar();
    }
    setActualiza(true);
  }

  const columnas = [
    {
      title: 'Id Foto',
      field: 'id',
      type: 'number'
    },
    {
      title: 'Descripción',
      field: 'nombrefoto'
    },
    {
      title: 'Fecha Foto',
      field: 'fechafoto'
    },
    {
      title: 'Tipo',
      field: 'type'
    },
    {
      title: 'Nombre Foto',
      field: 'name'
    }
  ]

  const mostrarFoto = (nombrefoto) => {
    window.open("https://imagenes.gimcloud.co/" + nombrefoto, "Foto Maquina")
  }

  const fotoEquipoEliminar = (
    <div className={styles.modal2}>
      <p>Estás seguro que deseas eliminar la Foto del Equipo <b>{fotoEquipoSeleccionado && fotoEquipoSeleccionado.name}</b>? </p>
      <div align="right">
        <Button color="secondary" onClick={() => borrarFotoEquipo()}> Confirmar </Button>
        <Button onClick={() => abrirCerrarModalEliminar()}> Cancelar </Button>

      </div>

    </div>
  )

  return (
    <div className="App">
      <div className={styles.modal}>
        <br />
        <MaterialTable
          columns={columnas}
          data={listConsultarFotosEquipos}
          title="FOTOS MAQUINAS"
          actions={[
            {
              icon: FileCopyIcon,
              tooltip: 'Consultar Foto',
              onClick: (event, rowData) => mostrarFotoEquipo(rowData, "Consultar")
            },
            {
              icon: 'delete',
              tooltip: 'Borrar Foto',
              onClick: (event, rowData) => seleccionarFotoEquipo(rowData, "Eliminar")
            }
          ]}
          options={{
            actionsColumnIndex: -1
          }}
          localization={{
            header: {
              actions: "Acciones"
            }
          }}
        />{ }
      </div>


      <Modal
        open={modalEliminar}
        onClose={abrirCerrarModalEliminar}
      >
        {fotoEquipoEliminar}
      </Modal>
    </div>
  );
}

export default ConsultarFotosEquipos;