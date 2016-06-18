import XCTest

class BowlingGameTest: XCTestCase {
    
    private var bowlingGame: BowlingGame = BowlingGame()
    
    override func setUp() {
        super.setUp()
        bowlingGame = BowlingGame()
    }
    
    func testInitialScoreIs0() {
        XCTAssertEqual(0, bowlingGame.score())
    }
    
    func testRolling0PinsInEachRollResultIn0Points() {
        for _ in 0 ... 19 {
            bowlingGame.roll(0)
        }
        
        XCTAssertEqual(0, bowlingGame.score())
    }
    
    func testRolling1PinInEachRollResultIn20Points() {
        for _ in 0 ... 19 {
            bowlingGame.roll(1)
        }
        
        XCTAssertEqual(20, bowlingGame.score())
    }
    
    func testOneSpare() {
        doASpare(bowlingGame)
        bowlingGame.roll(2)
        
        for _ in 0 ... 16 {
            bowlingGame.roll(0)
        }
        
        XCTAssertEqual(14, bowlingGame.score())
    }
    
    func testOneStrike() {
        doAStrike(bowlingGame)
        bowlingGame.roll(2)
        bowlingGame.roll(6)
        
        for _ in 0 ... 16 {
            bowlingGame.roll(0)
        }
        
        XCTAssertEqual(26, bowlingGame.score())
    }
    
    func testPerfectGame() {
        for _ in 0 ... 19 {
            bowlingGame.roll(10)
        }
        
        XCTAssertEqual(300, bowlingGame.score())
    }
    
    private func doASpare(bowlingGame: BowlingGame) {
        bowlingGame.roll(5)
        bowlingGame.roll(5)
    }
    
    private func doAStrike(bowlingGame: BowlingGame) {
        bowlingGame.roll(10)
    }
}