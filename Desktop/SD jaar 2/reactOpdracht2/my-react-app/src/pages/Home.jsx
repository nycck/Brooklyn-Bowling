import React from "react";
import { Container, Row, Col, Card, Button } from "react-bootstrap";
import { Link } from "react-router-dom";

import natuur1 from "../assets/olifant1.png";
import natuur2 from "../assets/olifant2.png";
import natuur3 from "../assets/olifant3.png";
import uitzicht from "../assets/uitzicht.png";

const Home = () => {
  return (
    <Container className="py-5">
      <h1 className="text-center mb-5 display-4 fw-bold text-primary">
        Welkom bij Natuur Wereld
      </h1>

      <Row className="g-5">
        {[natuur1, natuur2, natuur3].map((image, index) => (
          <Col key={index} xs={12} md={6} lg={4}>
            <Card className="shadow border-0">
              <Card.Img
                variant="top"
                src={image}
                alt={`Natuur ${index + 1}`}
                className="rounded"
                style={{ height: "200px", objectFit: "cover" }}
              />
              <Card.Body className="text-center">
                <Card.Title className="h5 text-dark">{`Natuur ${index + 1}`}</Card.Title>
                <Card.Text className="text-muted">
                  Ontdek meer over deze prachtige natuur.
                </Card.Text>
                <Button as={Link} to="/news" variant="success">
                  Meer weten
                </Button>
              </Card.Body>
            </Card>
          </Col>
        ))}
      </Row>

      <Row className="mt-5">
        <Col xs={12}>
          <Card className="shadow-lg border-0">
            <Card.Img
              variant="top"
              src={uitzicht}
              alt="Uitzicht over de savanne"
              className="rounded"
              style={{ height: "300px", objectFit: "cover" }}
            />
            <Card.Body className="text-center">
              <Card.Title className="h4 text-dark">Uitzicht over de savanne</Card.Title>
              <Card.Text className="text-muted">
                Een adembenemende plek waar de natuur vrij rondloopt in zijn natuurlijke habitat.
              </Card.Text>
              <Button as={Link} to="/news" variant="info">
                Meer weten
              </Button>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
};

export default Home;
