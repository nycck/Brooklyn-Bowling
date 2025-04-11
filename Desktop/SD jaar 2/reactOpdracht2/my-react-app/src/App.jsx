import React from "react";
import { BrowserRouter as Router } from "react-router-dom";
import { Container } from "react-bootstrap";
import NavbarComponent from "./components/Navbar";
import Routing from "./Routing"; // ✅ Import de Routing-component

import "bootstrap/dist/css/bootstrap.min.css";
import "./index.scss";

const App = () => {
  return (
    <Router>
      <NavbarComponent />
      <Container className="mt-4">
        <Routing /> {/* ✅ Gebruik hier Routing.jsx */}
      </Container>
    </Router>
  );
};

export default App;