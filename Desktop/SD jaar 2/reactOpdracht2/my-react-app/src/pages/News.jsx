import React from "react";
import { Container, Row, Col, Card, Button, Form, Badge } from "react-bootstrap";

import newsImage1 from "../assets/news1.jpg";
import newsImage2 from "../assets/news2.jpg";
import newsImage3 from "../assets/news3.jpg";

const News = () => {
  const newsArticles = [
    {
      title: "natuur in de Spotlight",
      text: "Lees meer over de natuur die de wereld veroveren in documentaires en natuurbescherming. Dit artikel geeft een uitgebreid overzicht van de huidige projecten en de impact die deze hebben op het behoud van deze majestueuze dieren.",
      image: newsImage1,
      link: "/contact",
      category: "Feature",
      date: "15 mei 2023"
    },
    {
      title: "Nieuw Behoudsproject Gelanceerd",
      text: "Een nieuw project voor het behoud van de natuursoorten is officieel van start gegaan.",
      image: newsImage2,
      link: "/contact",
      category: "Nieuws",
      date: "2 juni 2023"
    },
    {
      title: "De Toekomst van Natuurpopulaties",
      text: "Wat kunnen we verwachten voor de toekomst van Natuur in het wild? Lees de laatste onderzoeken.",
      image: newsImage3,
      link: "/contact",
      category: "Onderzoek",
      date: "22 juni 2023"
    },
  ];

  return (
    <Container className="py-5 my-4">
      <Row className="mb-4">
        <Col className="text-center">
          <h1 className="display-4 fw-bold" style={{ color: '#2c3e50' }}>
            Laatste Nieuws
          </h1>
          <p className="lead text-muted">
            Blijf op de hoogte van onze laatste updates en verhalen
          </p>
          <div className="d-flex justify-content-center">
            <Badge bg="info" className="mx-2">Natuur</Badge>
            <Badge bg="success" className="mx-2">Bescherming</Badge>
            <Badge bg="warning" className="mx-2">Onderzoek</Badge>
          </div>
        </Col>
      </Row>

      <Row className="g-4">
        {/* Main articles */}
        <Col lg={8}>
          {/* Featured article */}
          <Card className="mb-4 border-0 shadow-lg overflow-hidden">
            <Row className="g-0">
              <Col md={6}>
                <Card.Img 
                  src={newsArticles[0].image} 
                  alt={newsArticles[0].title}
                  className="h-100"
                  style={{ objectFit: 'cover' }}
                />
              </Col>
              <Col md={6}>
                <Card.Body className="p-4">
                  <Badge bg="primary" className="mb-2">{newsArticles[0].category}</Badge>
                  <Card.Title as="h2" className="mb-3" style={{ color: '#2c3e50' }}>
                    {newsArticles[0].title}
                  </Card.Title>
                  <Card.Text className="text-muted mb-4">
                    {newsArticles[0].text}
                  </Card.Text>
                  <div className="d-flex justify-content-between align-items-center">
                    <small className="text-muted">{newsArticles[0].date}</small>
                    <Button 
                      href={newsArticles[0].link} 
                      variant="outline-primary"
                      className="px-4"
                    >
                      Lees meer
                    </Button>
                  </div>
                </Card.Body>
              </Col>
            </Row>
          </Card>

          {/* Smaller articles */}
          <Row className="g-4">
            {newsArticles.slice(1).map((article, idx) => (
              <Col md={6} key={idx}>
                <Card className="h-100 border-0 shadow-sm">
                  <Card.Img
                    variant="top"
                    src={article.image}
                    alt={article.title}
                    style={{ height: "200px", objectFit: "cover" }}
                  />
                  <Card.Body>
                    <Badge bg="secondary" className="mb-2">{article.category}</Badge>
                    <Card.Title style={{ color: '#2c3e50' }}>{article.title}</Card.Title>
                    <Card.Text className="text-muted">{article.text}</Card.Text>
                  </Card.Body>
                  <Card.Footer className="bg-white border-0">
                    <div className="d-flex justify-content-between align-items-center">
                      <small className="text-muted">{article.date}</small>
                      <Button 
                        href={article.link} 
                        variant="outline-success" 
                        size="sm"
                      >
                        Lees meer
                      </Button>
                    </div>
                  </Card.Footer>
                </Card>
              </Col>
            ))}
          </Row>
        </Col>

        {/* Sidebar */}
        <Col lg={4}>
          <div className="sticky-top" style={{ top: "20px" }}>
            {/* Newsletter card */}
            <Card className="mb-4 border-0 shadow-sm bg-light">
              <Card.Body className="p-4">
                <div className="text-center mb-3">
                  <i className="bi bi-envelope-fill fs-1 text-primary"></i>
                </div>
                <h3 className="h4 text-center mb-3" style={{ color: '#2c3e50' }}>
                  Nieuwsbrief
                </h3>
                <p className="text-muted text-center mb-4">
                  Schrijf je in voor onze nieuwsbrief en blijf op de hoogte!
                </p>
                <Form>
                  <Form.Group className="mb-3">
                    <Form.Control 
                      type="email" 
                      placeholder="Je e-mailadres" 
                      className="py-2"
                    />
                  </Form.Group>
                  <Button 
                    variant="primary" 
                    type="submit" 
                    className="w-100 py-2"
                  >
                    Inschrijven
                  </Button>
                </Form>
              </Card.Body>
            </Card>

            {/* Trending articles */}
            <Card className="mb-4 border-0 shadow-sm">
              <Card.Body className="p-4">
                <h3 className="h4 mb-4" style={{ color: '#2c3e50', borderBottom: '2px solid #3498db', paddingBottom: '10px' }}>
                  <i className="bi bi-fire me-2"></i>Populaire Artikelen
                </h3>
                <div className="list-group list-group-flush">
                  <a href="/article1" className="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Waarom Natuur Cruciaal Zijn
                    <Badge bg="primary" pill>1</Badge>
                  </a>
                  <a href="/article2" className="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    De Grote Migratie
                    <Badge bg="primary" pill>2</Badge>
                  </a>
                  <a href="/article3" className="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Conserveren van de Savanne
                    <Badge bg="primary" pill>3</Badge>
                  </a>
                </div>
              </Card.Body>
            </Card>

            {/* Quick links */}
            <Card className="border-0 shadow-sm">
              <Card.Body className="p-4">
                <h3 className="h4 mb-4" style={{ color: '#2c3e50', borderBottom: '2px solid #3498db', paddingBottom: '10px' }}>
                  <i className="bi bi-link-45deg me-2"></i>Snelle Links
                </h3>
                <Button variant="outline-dark" className="w-100 mb-2 text-start d-flex align-items-center">
                  <i className="bi bi-newspaper me-2"></i> Alle Nieuws
                </Button>
                <Button variant="outline-dark" className="w-100 mb-2 text-start d-flex align-items-center">
                  <i className="bi bi-camera me-2"></i> Galerij
                </Button>
                <Button variant="outline-dark" className="w-100 text-start d-flex align-items-center">
                  <i className="bi bi-people me-2"></i> Ons Team
                </Button>
              </Card.Body>
            </Card>
          </div>
        </Col>
      </Row>
    </Container>
  );
};

export default News;