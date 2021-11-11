import React, { useEffect, useState } from "react";
import { Modal, Button, Form, Input, Typography, Row, Col, Select, InputNumber } from "antd";
import 'antd/dist/antd.css';
import swal from 'sweetalert';
import Moment from 'moment';
import 'reactjs-popup/dist/index.css';
import SignaturePad from 'react-signature-canvas';
import './firmarOT.css';

const { Item } = Form;
const { Password } = Input;
const { Title } = Typography;

// Componentes de Conexion con el Backend
import firmarotServices from "../../../../services/GestionOrdenes/FirmarOT";


function FirmarOT(props) {
    const { id_actividad } = props;

    console.log("NUMERO ORDEN : ", id_actividad);

    const [sigCanvas, setSigCanvas] = useState({});
    const [sigCanvasTecnico, setSigCanvasTecnico] = useState({});
    const [imageURL, setImageURL] = useState(null);
    const [imageURLTecnico, setImageURLTecnico] = useState(null);
    const [modalPendienteOT, setModalPendienteOT] = useState(false);
    const [formError, setFormError] = useState(false);
    const [grabar, setGrabar] = React.useState(false);
    const fechaactual = Moment(new Date()).format('YYYY-MM-DD');

    const [firmarotSeleccionado, setFirmarOTSeleccionado] = useState({
        id_fir: "",
        imagen_fir: "",
        nombre_fir: "",
        firmatecnico_fir: "",
        fechafirma_fir: "",
        observacion_fir: ""
    });

    const limpiar = () => {
        sigCanvas.current.clear();
        sigCanvasTecnico.current.clear();
    }

    const guardar = () => {
        setImageURL(sigCanvas.current.getTrimmedCanvas().toDataURL("image/png"));
        //setImageURLTecnico(sigCanvasTecnico.current.getTrimmedCanvas().toDataURL("image/png"));
        //console.log("Numero OT : ", id_actividad)
        setFirmarOTSeleccionado([{
            id_fir: id_actividad,
            imagen_fir: sigCanvas.current.getTrimmedCanvas().toDataURL("image/png"),
            //firmatecnico_fir: sigCanvasTecnico.current.getTrimmedCanvas().toDataURL("image/png"),
            firmatecnico_fir: "",
            nombre_fir: id_actividad + "firmagimcloudot",
            fechafirma_fir: fechaactual,
            observacion_fir:  firmarotSeleccionado.observacion_fir
        }]);
        setGrabar(true);
    }

    useEffect(() => {
        if (grabar) {
            console.log("DATOS IMAGEN : ", firmarotSeleccionado[0])

            async function fetchDataGrabarImagen() {
                const res = await firmarotServices.save(firmarotSeleccionado[0]);
                console.log("Mensaje desde el Servidor : ", res.data);

                if (res.success) {
                    swal("Firma OT Cliente", "Grabada de Forma Correcta!", "success", { button: "Aceptar" });
                    console.log(res.message)
                    abrirCerrarModalPendienteOT();
                }
                else {
                    swal("Firma OT Client", "Error Grabando Firma de la OT!", "error", { button: "Aceptar" });
                    console.log(res.message);
                    abrirCerrarModalPendienteOT();
                }
            }
            fetchDataGrabarImagen();
        
        }
    }, [grabar])

    const handleChange = e => {
        const { name, value } = e.target;

        setFirmarOTSeleccionado(prevState => ({
            ...prevState,
            [name]: value
        }));
    }

    const seleccionarCumplimiento = (cumplimiento, caso) => {
        //console.log(cumplimiento)
        setPendienteSeleccionado(cumplimiento);
        (caso === "Editar") ? abrirCerrarModalActualizarCumplimiento() : abrirCerrarModalEliminarActividad()
    }

    const abrirCerrarModalPendienteOT = () => {
        setModalPendienteOT(!modalPendienteOT);
    }

    const layout = {
        labelCol: {
            span: 8
        },
        wrapperCol: {
            span: 16
        }
    }

    return (
        <div className="App">
            <Title align="center" type="warning" level={4} >
                Firma Cliente
            </Title>
            <Row justify="center" >
                <Col span={12}>
                    <SignaturePad canvasProps={{}}
                        ref={sigCanvas}
                        canvasProps={{
                            className: "firmarOT",

                        }} />
                </Col>
            </Row>
            <Row justify="center" >
                <Col span={18}>
                    <Item
                        label="Observación Cliente"
                    >
                        <Input
                            style={{ width: 420 }}
                            name='observacion_fir'
                            onChange={handleChange}
                            value={firmarotSeleccionado && firmarotSeleccionado.observacion_fir}
                        ></Input>
                    </Item>
                </Col>
            </Row>

            <Row justify="center" >
                <Col span={6}>
                    <Button className="limpiar" onClick={limpiar}>
                        Limpiar Area de Firma
                    </Button>
                </Col>
                <Col span={6}>
                    <Button className="guardar" onClick={guardar}>
                        Guardar Firma
                    </Button>
                </Col>
            </Row>

            <Row justify="center" >
                <Col span={8}>
                    {
                        imageURL ?
                            <img
                                src={imageURL}
                                alt="firma"
                                style={{
                                    display: "block",
                                    margin: "0 auto",
                                    border: "1px solid black",
                                    width: "200px"
                                }}
                            />
                            :
                            null
                    }
                </Col>
            </Row>

        </div>
    );
}

export default FirmarOT;