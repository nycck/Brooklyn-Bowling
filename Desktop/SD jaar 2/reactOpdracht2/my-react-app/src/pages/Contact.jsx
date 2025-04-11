import React, { useState } from "react";
import { Container, Row, Col, Card, Form, Button } from "react-bootstrap";

const Contact = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    alert("Formulier verzonden!");
  };

  return (
    <Container className="py-5">
      <Row className="g-5 align-items-stretch">
        {/* Contact info */}
        <Col md={5}>
          <Card className="p-4 h-100 shadow-sm border-0">
            <Card.Body>
              <h2 className="text-primary mb-4 fw-bold">Contactgegevens</h2>
              <p className="text-muted">Heb je vragen of opmerkingen? Neem gerust contact met ons op.</p>
              <div className="mt-4">
                <p><strong>Adres:</strong> Olifantenlaan 12, 1234 AB Safari-stad</p>
                <p><strong>Telefoon:</strong> +31 6 12345678</p>
                <p><strong>E-mail:</strong> info@liefde.nl</p>
              </div>
              <div className="mt-4">
                <p className="text-muted small">Wij reageren meestal binnen 24 uur.</p>
              </div>
            </Card.Body>
          </Card>
        </Col>

        {/* Formulier */}
        <Col md={7}>
          <Card className="shadow-lg border-0">
            <Card.Body className="p-4">
              <h1 className="text-center mb-4 display-6 fw-bold text-primary">
                Neem Contact met Ons Op
              </h1>
              <p className="text-center mb-4 text-muted">
                Vul het formulier hieronder in en we nemen zo snel mogelijk contact met je op.
              </p>

              <Form onSubmit={handleSubmit}>
                <Row className="g-3">
                  <Col xs={12} md={6}>
                    <Form.Group controlId="formName">
                      <Form.Label>Naam</Form.Label>
                      <Form.Control
                        type="text"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                        placeholder="Voer je naam in"
                        required
                      />
                    </Form.Group>
                  </Col>
                  <Col xs={12} md={6}>
                    <Form.Group controlId="formEmail">
                      <Form.Label>Email</Form.Label>
                      <Form.Control
                        type="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                        placeholder="Voer je e-mail in"
                        required
                      />
                    </Form.Group>
                  </Col>
                </Row>
                <Form.Group controlId="formMessage" className="mt-3">
                  <Form.Label>Bericht</Form.Label>
                  <Form.Control
                    as="textarea"
                    name="message"
                    rows={5}
                    value={formData.message}
                    onChange={handleChange}
                    placeholder="Schrijf je bericht hier"
                    required
                  />
                </Form.Group>
                <Button variant="primary" type="submit" className="w-100 mt-4">
                  Verstuur Bericht
                </Button>
              </Form>
            </Card.Body>
          </Card>
        </Col>
      </Row>

      {/* Inline Styling */}
      <style jsx>{`
        #root {
          background-color: #f5f7fa;
          font-family: 'Roboto', sans-serif;
        }

        .form-control {
          border-radius: 8px;
        }

        .btn-primary {
          background-color: #007bff;
          border-color: #007bff;
          padding: 0.75rem 1.5rem;
          border-radius: 30px;
          transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
          background-color: #0056b3;
          border-color: #0056b3;
        }

        @media (max-width: 768px) {
          h1 {
            font-size: 2rem;
          }
        }
      `}</style>
    </Container>
  );
};

export default Contact;
