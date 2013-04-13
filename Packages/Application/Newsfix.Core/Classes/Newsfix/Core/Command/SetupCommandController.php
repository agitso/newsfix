<?php

namespace Newsfix\Core\Command;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class SetupCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @var \Newsfix\Core\Domain\Repository\ArticleRepository
	 * @Flow\Inject
	 */
	protected $articleRepository;

	/**
	 * @return void
	 */
	public function importCommand() {
		$this->articleRepository->removeAll();

		$article = new \Newsfix\Core\Domain\Model\Article();
		$article->setTitle('Bondo: Brev fra KL er et mediestunt');
		$article->setAbstract('Formanden for Danmarks Lærerforening kendte intet til brevet, inden han blev ringet op af en journalist.');
		$article->addContent(new \Newsfix\Core\Domain\Model\Content(
			'',
			'Fredag sendte Erik Nielsen, formand for Kommunernes Landsforening, et brev, der var stilet til Anders Bondo Christensen, formand for Danmarks Lærerforening.

			I brevet bliver Anders Bondo Christensen beskyldt for at tage eleverne og lærerne som gidsler, og Erik Nielsen opfordrer derfor lærernes formand til at komme tilbage til forhandlingsbordet.

			Men nu sætter Anders Bondo Christensen spørgsmålstegn ved formålet med brevet - han fik nemlig kendskab til det på en usædvanlig måde.

			"Det er et meget mærkeligt brev. Jeg har henvendt mig til KL for at få at vide, hvem brevet er sendt til, for jeg fik først kendskab til det, da jeg blev ringet op af en journalist fra Politiken," siger Anders Bondo Christensen til Jyllands-Posten.'
		));

		$article->addContent(new \Newsfix\Core\Domain\Model\Content(
			'Mediestunt?',
			'I brevet fra KL understreger Erik Nielsen, at Danmarks Lærerforening har forsøgt at få befolkningen på sin side ved at bruge medierne.

			"Tiden er kommet til at lægge mediestrategier og forsøg på at påvirke Folketinget til side, og møde op til reelle forhandlinger, for at sikre dine medlemmer det bedst mulige resultat," srkiver Erik Nielsen i brevet.

			I Danmarks Lærerforening ryster man på hovedet af brevet - her mener man nemlig, at KL gør det, man beskylder lærerne for at gøre. Nemlig bruge medierne.

			"Brevet er et mediestunt. Jeg er ked af, at KL er så useriøs, for det er situationen alt for alvorlig til. Jeg bliver beskyldt for at tage elever og forældre som gidsler, men det er jo KL, der har lockoutet lærerne," siger Anders Bondo Christensen.'
		));

		$this->articleRepository->add($article);
	}
}