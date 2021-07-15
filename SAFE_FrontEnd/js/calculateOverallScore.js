function add_number() {

    var Score1 = parseInt(document.getElementById("AppropriatenessOfTopic").value);
    var Score2 = parseInt(document.getElementById("TimelinessOfTopic").value);
    var Score3 = parseInt(document.getElementById("SupportiveEvidence").value);
    var Score4 = parseInt(document.getElementById("TechnicalQuality").value);
    var Score5 = parseInt(document.getElementById("ScopeOfCoverage").value);
    var Score6 = parseInt(document.getElementById("CitationOfPreviousWork").value);
    var Score7 = parseInt(document.getElementById("Originality").value);
    var Score8 = parseInt(document.getElementById("OrganizationOfPaper").value);
    var Score9 = parseInt(document.getElementById("ClarityOfMainMessage").value);
    var Score10 = parseInt(document.getElementById("Mechanics").value);
    var Score11 = parseInt(document.getElementById("SuitabilityForPresentation").value);
    var Score12 = parseInt(document.getElementById("ComfortLevelTopic").value);
    var Score13 = parseInt(document.getElementById("ComfortLevelAcceptability").value);
    var Score14 = parseInt(document.getElementById("PotentialInterestInTopic").value);

    var result = parseInt(Score1 + Score2 + Score3 + Score4 + Score5 + Score6 + Score7 + Score8 + Score9 + Score10 + Score11 + Score12 + Score13 + Score14) / 14;

    document.getElementById("OverallRating").value = result;
}