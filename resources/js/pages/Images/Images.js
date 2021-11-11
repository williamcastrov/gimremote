import React, { Fragment, useEffect, useState } from 'react';
import swal from 'sweetalert';
import imageCompression from "browser-image-compression";
import { Modal, Button, Form, Input, Typography, Row, Col, Select, InputNumber } from "antd";
import 'antd/dist/antd.css';

const { Item } = Form;
const { Password } = Input;
const { Title } = Typography;

function Images(props) {
    const { numeroactividad, operario } = props;
    console.log("NUMERO ORDEN : ", numeroactividad)
    console.log("OPERARIO : ", operario)
    const [modalGrabar, setModalGrabar] = useState(true);
    const [file, setFile] = useState(null)
    const [compressedLink, setCompressedLink] = useState("https://testersdock.com/wp-content/uploads/2017/09/file-upload-1280x640.png");
    const [originalImage, setOriginalImage] = useState("");
    const [originalLink, setOriginalLink] = useState("");
    const [outputFileName, setOutputFileName] = useState("");
    const [clicked, setClicked] = useState(false);
    const [uploadImage, setUploadImage] = useState(false);
    const [actualiza, setActualiza] = useState(false);
    const [cargaImagen, setCargaImagen] = useState(false);
    const [mostrar, setMostrar] = useState(false);

    const selectedHandler = e => {
        setFile(e.target.files[0])
    }

    const abrirModalGrabar = () => {
        setModalGrabar(true);
    }

    const cerrarModalGrabar = () => {
        setModalGrabar(false);
    }

    const handle = e => {
        const imageFile = e.target.files[0];

        setOriginalLink(URL.createObjectURL(imageFile));
        setOriginalImage(imageFile);
        setOutputFileName(imageFile.name);
        setUploadImage(true);
        setClicked(true);
        setActualiza(true);
    };

    useEffect(() => {
        if (actualiza) {
            const options = {
                maxSizeMB: 2,
                maxWidthOrHeight: 800,
                useWebWorker: true
            };

            if (options.maxSizeMB >= originalImage.size / 1024) {
                alert("Imagen no requiere cambio de tamaño");
                return 0;
            }

            let output;
            console.log("IMAGEN ORIGINAL : ", originalImage);

            imageCompression(originalImage, options).then(x => {
                output = x;
                setFile(x);
                console.log("ARCHIVO COMPRIMIDO : ", x)
                const downloadLink = URL.createObjectURL(output);
                setCompressedLink(downloadLink);
                setCargaImagen(true);
            });

            //setClicked(true);
            //return 1;
        }
    }, [actualiza])


    const sendHandler = () => {
        /*
        if (operario) {
            swal("Registro de Fotos", "Esta Opción esta en desarrollo", "warning", { button: "Aceptar" });
            return
        }
        */
        //console.log(file)
        if (!file) {
            return
        }

        const formdata = new FormData();
        formdata.append('image', file)
        formdata.append('orden', numeroactividad)
        console.log("FORM DATA : ", formdata)

        setMostrar(true);
        setActualiza(false);
        
        //fetch('http://localhost:9000/api/imagenes/post', {
        fetch('https://imagenes.gimcloud.co/api/imagenes/post', {
            method: 'POST',
            body: formdata
        })
            .then(res => res.text())
            .then(
                res => swal("Fotos OT", "Ingreso de Fotos OK", "success", { button: "Aceptar" })

            )
            .catch(err => {
                swal("Fotos OT", "Error Grabando Fotos", "error", { button: "Aceptar" })
            })

        document.getElementById('fileinput').value = null;
        setFile(null);

        //history.push("/gim");
    }

    useEffect(() => {
        if (mostrar) {
            setCargaImagen(false);
            setMostrar(false);
        }
    }, [mostrar])

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
            <div >
                <Title align="center" type="warning" level={4} >
                    Imagen Original
                </Title>
                <Row justify="center" >
                    <Col span={24}>
                        <input
                            type="file"
                            accept="image/*"
                            className="mt-2 btn btn-dark w-75"
                            onChange={e => handle(e)}
                        />
                    </Col>
                </Row>
                <br />
                <Row justify="center" >
                    <Col span={8}>
                        {cargaImagen ?
                            (
                                <Button type="primary" size="large" onClick={sendHandler} >Guardar</Button>
                            )
                            :
                            (
                                <></>
                            )}
                    </Col>
                </Row>
                <div className="col-xl-12 col-lg-4 col-md-12 col-sm-12 mt-3">

                    {
                        cargaImagen ?
                            <Title align="center" level={5}>
                                Imagen Ajustada - Subir a GIM Cloud
                            </Title>
                            :
                            console.log("Imagen Pendiente")

                    }

                </div>

            </div >
        </div>
    );
}

export default Images;