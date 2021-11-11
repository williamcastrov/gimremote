import React, { useState, useEffect } from "react";
import { validateEmail } from "../../../server/Validations";
import { MDBContainer, MDBRow, MDBCol, MDBCard, MDBCardBody, MDBModalFooter, MDBIcon, MDBCardHeader, MDBBtn } from "mdbreact";
import "./Login.css";
import Button from 'react-bootstrap/Button';

//Firebase
import firebase from "../../../server/firebase";
import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword, onAuthStateChanged } from "firebase/auth";

function Login(props) {
    const [formData, setFormData] = useState(defaultValueForm());
    const [formError, setFormError] = useState({});
    const [isLoading, setIsLoading] = useState(false);

    const onSubmit = (e) => {
        e.preventDefault();

        setFormError({});
        let errors = {};
        let formOk = true;

        if (!validateEmail(formData.email)) {
            errors.email = true;
            formOk = false;
        }
        if (formData.password.length < 6) {
            errors.password = true;
            formOk = false;
        }
        setFormError(errors);

        if (formOk) {
            //setIsLoading(true);

            const auth = getAuth(firebase);
            signInWithEmailAndPassword(auth, formData.email, formData.password)
                .then((response) => {
                    swal({
                        title: "Login",
                        text: "Acceso a GIM Cloud OK!",
                        icon: "success",
                        button: "Aceptar"
                    });
                })
                .catch((err) => {
                    handlerErrors(err.code);
                    swal({
                        title: "Login",
                        text: "Error al Intentar la Conexion... Intente mas Tarde!",
                        icon: "warning",
                        button: "Aceptar",
                    });
                })
                .finally(() => {
                    //setIsLoading(false);
                });
        }
    }

    const onChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });
    };

    //<MDBCol md="6">

    return (
            <div className="abs-center">
                <MDBContainer>
                    <MDBRow>
                        <MDBCol>
                            <MDBCard  className="mdbcontainer" >
                                <MDBCardBody>
                                    <div className="card-header">
                                          <MDBCardHeader className=" warm-flame-gradient rounded">
                                        <h3 className="my-3 text-center">
                                            <MDBIcon icon="lock" /> LOGISTRAL S.A. - GIM Cloud
                                        </h3>
                                    </MDBCardHeader>
                                    </div>
                                  
                                    <form onSubmit={onSubmit} onChange={onChange} >
                                        <label
                                            htmlFor="defaultFormEmailEx"
                                            className="grey-text font-weight-light"
                                        >
                                           Email
                                        </label>
                                        <input
                                            type="email"
                                            name="email"
                                            id="defaultFormEmailEx"
                                            className="form-control"
                                        />

                                        <label
                                            htmlFor="defaultFormPasswordEx"
                                            className="grey-text font-weight-light"
                                        >
                                            Password
                                        </label>
                                        <input
                                            type="password"
                                            name="password"
                                            id="defaultFormPasswordEx"
                                            className="form-control"
                                        />
                                        <div className="text-center mt-4">
                                            <Button className="buttonlogin" type="submit">
                                                Ingresar
                                            </Button>
                                        </div>
                                    </form>
                                    <div className="footer"> 
                                        
                                            <h3>Soluciones en Tiempo Real</h3>
                                       
                                    </div>
                                </MDBCardBody>
                            </MDBCard>
                        </MDBCol>
                    </MDBRow>
                </MDBContainer>
            </div>

    );
}

function defaultValueForm() {
    return {
        email: "",
        password: "",
    };
}


export default Login;